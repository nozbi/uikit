window.tree = 
{
    showSubtree(subtreeId)
    {
        document.getElementById(subtreeId).style.display = '';
    },

    hideSubtree(subtreeId)
    {
        document.getElementById(subtreeId).style.display = 'none';
    },

    init(divId, localStorageKey, id, defaultIsToggled)
    {
        let div = document.getElementById(divId);
        let button = div.parentElement.closest('button');
        button.id = id;
        button.dataset.localStorageKey = localStorageKey;
        let isToggled = defaultIsToggled;
        if (button.dataset.isToggled === undefined)
        {
            if (defaultIsToggled)
            {
                button.dataset.isToggled = 'true';
            }
            else
            {
                button.dataset.isToggled = 'false';
            } 
        }
        else
        {
            isToggled = button.dataset.isToggled === 'true';
        }
        button.addEventListener('click', this.onClicked);
        tree.restore(localStorageKey, id, isToggled)
    },

    onClicked(event)
    {
        const button = event.currentTarget;
        const isToggled = button.dataset.isToggled;
        if (isToggled === 'true')
        {
            button.dataset.isToggled = 'false';
            tree.save(button.dataset.localStorageKey, 'false');
        }
        else
        {
            button.dataset.isToggled = 'true';
            tree.save(button.dataset.localStorageKey, 'true');
        }
    },

    save(localStorageKey, state)
    {
        localStorage.setItem(localStorageKey, state);
    },

    restore(localStorageKey, id, isToggled)
    {
        const wasToggledString = localStorage.getItem(localStorageKey);
        if (wasToggledString === null)
        {
            return;
        }
        const wasToggled = wasToggledString !== 'false';
        const button = document.getElementById(id);
        if (isToggled === true)
        {
            button.dataset.isToggled = 'true';
        }
        else
        {
            button.dataset.isToggled = 'false';
        }
        if (!wasToggled && isToggled === true)
        {
            button.click();
        }
        else if (wasToggled && isToggled === false)
        {
            button.click();
        }
    }
};