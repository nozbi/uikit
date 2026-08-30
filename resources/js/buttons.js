window.buttons = 
{
    addListeners(id, sourceOffset, targetOffset) 
    {
        const idDiv = document.getElementById(id);
        const totalSourceOffset = sourceOffset + 2;
        const totalTargetOffset = targetOffset + 2;
        let tempSource = idDiv;
        for (let i = 0; i < totalSourceOffset; i++) 
        {
            tempSource = tempSource.parentElement;
        }
        const source = tempSource;
        let tempTarget = idDiv;
        for (let i = 0; i < totalTargetOffset; i++) 
        {
            tempTarget = tempTarget.firstElementChild;
        }
        const target = tempTarget;
        if (!source._customEventsPropagator_targets) {
            source._customEventsPropagator_targets = [];
        }
        source._customEventsPropagator_targets.push(target);
        source.addEventListener('focus', this.propagate);
        source.addEventListener('blur', this.propagate);
        source.addEventListener('keydown', this.propagate);
        source.addEventListener('keyup', this.propagate);
    },

    propagate(event)
    {
        const source = event.currentTarget;
        const targets = source._customEventsPropagator_targets || [];
        if (!targets)
        {
            event.stopPropagation();
            return;
        }
        const type = event.type;
        if (type === 'focus' && !source.matches(':focus-visible'))
        {
            return;
        }
        targets.forEach(target => {
            if (type === 'keydown' || type === 'keyup') 
            {
                target.dispatchEvent(new KeyboardEvent(type, 
                {
                    bubbles: false,
                    code: event.code
                }));
                return
            } 
            target.dispatchEvent(new Event(type, 
            {
                bubbles: false
            }));
        });
    },

    onClicked(untoggledHideablePanelId, toggledHideablePanelId, onToggled, onUntoggled) 
    {
        const isToggled = document.getElementById(untoggledHideablePanelId).style.display === 'none';
        let idToHide;
        let idToShow;
        if (isToggled)
        {
            new Function(onUntoggled)();
            idToHide = toggledHideablePanelId;
            idToShow = untoggledHideablePanelId;
        }
        else
        {
            new Function(onToggled)();
            idToHide = untoggledHideablePanelId;
            idToShow = toggledHideablePanelId;
        }
        this.setDisplay(idToHide, 'none');
        this.setDisplay(idToShow, '');
    },

    setDisplay(id, display) 
    {
        document.getElementById(id).style.display = display;
    },

    show(id) 
    {
        this.setDisplay(id, '');
    },

    hide(id) 
    {
        this.setDisplay(id, 'none');
    }
};