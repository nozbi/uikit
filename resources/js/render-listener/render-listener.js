window.renderListener = 
{
    addRenderListener(onRender)
    {
        if (window.Livewire) 
        {
            document.addEventListener('DOMContentLoaded', () => 
            {
                eval(onRender);
            });
            document.addEventListener('livewire:navigated', () => 
            {
                eval(onRender);
            }, { once: true })
        }
        else
        {
            window.addEventListener('pageshow', () => {
                eval(onRender);
            }); 
        }
    }
};