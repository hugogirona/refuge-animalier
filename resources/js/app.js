import './bootstrap';
import './form-progress';

if (!window.Alpine) {
    import('alpinejs').then(module => {
        const Alpine = module.default
        import('@alpinejs/collapse').then(collapseModule => {
            window.Alpine = Alpine
            Alpine.plugin(collapseModule.default)
            Alpine.start()
        })
    })
}



