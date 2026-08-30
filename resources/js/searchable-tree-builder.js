window.searchableTreeBuilder = 
{
    expandAll(treeId)
    {
        this.changeAllSubtreesState(treeId, true);
    },

    collapseAll(treeId) 
    {
        this.changeAllSubtreesState(treeId, false);
    },

    changeAllSubtreesState(treeId, isExpanding)
    {
        const buttons = Array.from(document.getElementById(treeId).querySelectorAll('button'));
        for (const button of buttons) 
        {
            const isToggledString = button.dataset.isToggled;
            if (isToggledString === undefined) 
            {
                continue;
            }
            const isToggled = isToggledString === 'true';
            if ((isToggled && isExpanding) || (!isToggled && !isExpanding)) 
            {
                continue;
            }
            button.click();
        }
    },

    getNodes(treeId)
    {
        const nodes = [];
        this.getNodesContainers(treeId).forEach(container => 
        {
            const realNodesContainer = container.firstElementChild;
            const containerNodes = realNodesContainer.children;
            for (const containerNode of containerNodes) 
            {
                if (containerNode.tagName === "SCRIPT")
                {
                    continue;
                }
                if (containerNode.id.startsWith('customIteractiveTree-'))
                {
                    continue;
                }
                nodes.push(containerNode);
            }
        });
        return nodes;
    },

    getNodesContainers(treeId)
    {
        const root = document.getElementById(treeId);
        const prefix = 'customIteractiveTree-';
        const subtreeContainers = Array.from(root.querySelectorAll(`div[id^="${prefix}"]`));
        const nodesContainers = subtreeContainers.concat(root);
        return nodesContainers;
    },

    mark(treeId, searchedText)
    {
        searchedText = searchedText.toLowerCase();
        this.getNodes(treeId).forEach(node => 
        {
            const unwrappedNode = this.unwrap(node);
            const text = unwrappedNode.innerText.toLowerCase();
            if ((searchedText !== '') && (text.includes(searchedText))) 
            {
                this.wrap(unwrappedNode, searchedText);
            }
        }); 
    },

    search(event, treeId, searchBarId, localStorageKey) 
    {
        this.expandAll(treeId);
        const searchedText = event.target.value;
        this.mark(treeId, searchedText);
        if (localStorageKey)
        {
            this.saveSearchBar(searchBarId, localStorageKey);
        }
        if (searchedText === '')
        {
            return;
        }
        this.getNodesContainers(treeId).forEach(container => 
        {
            if (container.querySelectorAll('mark').length === 0) 
            {
                const subtreeToggleContainer = (() => 
                {
                    let previousSibling = container.previousElementSibling;
                    while (previousSibling !== null && previousSibling.tagName === 'SCRIPT') 
                    {
                        previousSibling = previousSibling.previousElementSibling;
                    }
                    return previousSibling;
                })();
                if (subtreeToggleContainer !== null)
                {
                    const subtreeToggleButton = subtreeToggleContainer.firstElementChild.firstElementChild;
                    subtreeToggleButton.click();
                }
            }
        });
    },

    wrap(node, searchedText)
    {
        let textContainers = null;
        if (node.children.length === 0 && node.innerText.trim() !== "") 
        {
            textContainers = [node];
        }
        else
        {
            textContainers = [...node.querySelectorAll("div")].filter(d => d.children.length === 0 && d.innerText.toLowerCase().includes(searchedText.toLowerCase()));
        }
        for (const textContainer of textContainers)
        {
            const regex = new RegExp(searchedText, "gi");
            textContainer.innerHTML = textContainer.innerHTML.replace(regex, match => `<mark>${match}</mark>`);
        }
    },

    unwrap(node) 
    {
        let unwrappedNode = node;
        let marks = null;
        if (node.tagName.toLowerCase() === 'mark') 
        {
            marks = [node];
            unwrappedNode = node.firstChild;
        }
        else
        {
            marks = Array.from(node.querySelectorAll('mark'));
        }
        for (const mark of marks)
        {
            mark.parentNode.replaceChild(mark.firstChild, mark);
        }
        return unwrappedNode;
    },

    restoreSearchBar(searchBarId, localStorageKey, treeId)
    {
        if (localStorageKey === null)
        {
           return; 
        }
        const text = localStorage.getItem(localStorageKey);
        if (text === null || text === '')
        {
            return;
        }
        let searchBar = document.getElementById(searchBarId).querySelector('input');
        searchBar.value = text;
        searchableTreeBuilder.mark(treeId, text);
    },

    saveSearchBar(searchBarId, localStorageKey)
    {
        localStorage.setItem(localStorageKey, document.getElementById(searchBarId).querySelector('input').value);
    },
};