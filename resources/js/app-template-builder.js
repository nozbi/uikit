window.appTemplateBuilder = {
    toggle(dropdownId, buttonId, maxMobileWidth) 
    {
        if (window.innerWidth < maxMobileWidth)
        {
            const sideBarToggle = document.getElementById("uikit-app-template-builder-side-bar-toggle-slot");
            const boundingClientRect = sideBarToggle.getBoundingClientRect();
            const visible = boundingClientRect.top < window.innerHeight && boundingClientRect.bottom > 0 && boundingClientRect.left < window.innerWidth && boundingClientRect.right > 0;
            if (!visible) 
            {
                sideBarToggle.click();
            }
            
        }
        const dropdown = document.getElementById(dropdownId);
        const rect = document.getElementById(buttonId).querySelector("button").getBoundingClientRect();
        dropdown.style.top = rect.bottom + "px";
        dropdown.style.left = (rect.right - parseInt(dropdown.style.width, 10)) + "px";
        dropdown.style.maxHeight = (window.innerHeight - rect.bottom) + "px";
        dropdown.style.display = "block";
    },

    untoggle(dropdownId) 
    {
        document.getElementById(dropdownId).style.display = "none";
    },

    init(dropdownId, buttonId) 
    {
        const btn = document.getElementById(buttonId).querySelector("button");
        const dropdown = document.getElementById(dropdownId);
        document.addEventListener("click", (event) => 
        {
            appTemplateBuilder.hideDropdownOnClick(event, btn, dropdown);
        }, true);
        document.addEventListener("scroll", (event) => 
        {
            appTemplateBuilder.hideDropdownOnScroll(event, btn, dropdown);
        }, true);
        window.addEventListener("resize", () => 
        {
            appTemplateBuilder.hideDropdown(btn, dropdown);
        });
    },

    hideDropdownOnClick(event, btn, dropdown) 
    {
        if (dropdown.style.display === "block" && !dropdown.contains(event.target) && !btn.contains(event.target)) 
        {
            appTemplateBuilder.hideDropdown(btn, dropdown);
        }
    },

    hideDropdownOnScroll(event, btn, dropdown) 
    {
        const t = event.target;
        if (dropdown.style.display === "block" && t !== dropdown && !dropdown.contains(t) && t !== btn && !btn.contains(t)) 
        {
            appTemplateBuilder.hideDropdown(btn, dropdown);
        }
    },

    hideDropdown(btn, dropdown) 
    {
        if (dropdown.style.display === "block") 
        {
            btn.click();
        }
    }
};