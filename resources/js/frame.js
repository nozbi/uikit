window.frame = 
{
    blockStateRestoreIfMobile(rootId, minSplitWidth, localStorageKey)
    {
        if (document.getElementById(rootId).offsetWidth < minSplitWidth) 
        {  
            localStorage.removeItem(localStorageKey); 
        } 
    },

    showSidebar(sidebarId, localStorageKey)
    {
        document.getElementById(sidebarId).style.display = 'block';
        this.saveSidebarVisibility(localStorageKey, true);
    },

    hideSidebar(sidebarId, localStorageKey)
    {
        document.getElementById(sidebarId).style.display = 'none';
        this.saveSidebarVisibility(localStorageKey, false);
    },

    saveSidebarVisibility(localStorageKey, isVisible)
    {
        if (localStorageKey === null)
        {
            return;
        }
        localStorage.setItem(localStorageKey, isVisible);
    },

    restoreSidebarVisibility(sidebarId, localStorageKey, toggleId)
    {
        if (localStorageKey === null)
        {
           return; 
        }
        const wasVisibleString = localStorage.getItem(localStorageKey);
        if (wasVisibleString === null)
        {
            return;
        }
        const wasVisible = wasVisibleString === 'true';
        const isVisible = document.getElementById(sidebarId).style.display === 'block';
        if (wasVisible !== isVisible)
        {
            document.getElementById(toggleId).querySelector('button').click();
        }
    }
};