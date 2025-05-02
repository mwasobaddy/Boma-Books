<script>
    document.addEventListener('livewire:initialized', () => {
        // Prevent scroll reset on Livewire updates
        Livewire.hook('commit.prepare', ({component}) => {
            // Store the scroll position before updates
            component.effects.scroll = {
                x: window.scrollX,
                y: window.scrollY
            };
        });

        // Restore scroll position after updates
        Livewire.hook('commit.finished', ({component}) => {
            if (component.effects.scroll) {
                window.scrollTo(component.effects.scroll.x, component.effects.scroll.y);
            }
        });
    });
</script>

{{ $slot }}