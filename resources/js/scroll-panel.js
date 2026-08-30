window.scrollPanel = 
{
    init(id, localStorageKey)
    {
        const scrollTopKey = localStorageKey + '_top';
        const scrollLeftKey = localStorageKey + '_left';
        const scrollPanel = document.getElementById(id);
        let scrollTop = parseInt(localStorage.getItem(scrollTopKey), 10) || 0;
        let scrollLeft = parseInt(localStorage.getItem(scrollLeftKey), 10) || 0;
        scrollPanel.addEventListener('scroll', () => 
        {
            localStorage.setItem(scrollTopKey, scrollPanel.scrollTop);
            localStorage.setItem(scrollLeftKey, scrollPanel.scrollLeft);
        });
        scrollPanel.style.visibility = 'visible';  
        requestAnimationFrame(() =>
        {
            scrollPanel.scrollTop = scrollTop
            scrollPanel.scrollLeft = scrollLeft;       
        });
    }
};