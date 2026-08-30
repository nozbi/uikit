window.appTemplate =
{
    updateColor(el)
    {
        if ((el.dataset.keyboardPressed === '1') || (el.dataset.pressed === '1'))
        {
            el.style.color = el.dataset.pressedColor;
        }
        else if ((el.matches(':hover')) || (el.dataset.focusVisible === '1'))
        {
            el.style.color = el.dataset.hoveredColor;
        }
        else
        {
            el.style.color = el.dataset.color;
        }
    },

    handleEnter(el)
    {
        el.dataset.hover = '1';
        this.updateColor(el);
    },

    handleLeave(el)
    {
        el.dataset.hover = '0';
        this.updateColor(el);
    },

    handleDown(el)
    {
        el.dataset.pressed = '1';
        window.__lastPressed = el.id;
        this.updateColor(el);
    },

    handleFocus(el)
    {
        el.dataset.focusVisible = '1';
        this.updateColor(el);
    },

    handleBlur(el)
    {
        el.dataset.focusVisible = '0';
        this.updateColor(el);
    },

    handleKeyboardEvent(div, event)
    {
        const code = event.code;
        if (code !== 'Enter' && code !== 'Space')
        {
            return;
        }
        const parent = div.closest('button, a');
        if ((parent.tagName === 'A') && code === 'Space')
        {
            return;
        }
        if (event.type === 'keydown')
        {
            div.dataset.keyboardPressed = '1';
        }
        else
        {
            div.dataset.keyboardPressed = '0';
        }
        this.updateColor(div);
    },

    handleUp()
    {
        const id = window.__lastPressed;
        if (!id)
        {
            return;
        }
        const el = document.getElementById(id);
        if (!el)
        {
            return;
        }
        el.dataset.pressed = '0';
        this.updateColor(el);
        window.__lastPressed = null;
    }
};

document.addEventListener('pointerup', appTemplate.handleUp.bind(appTemplate));