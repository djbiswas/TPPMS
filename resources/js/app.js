
import Alpine from 'alpinejs';
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.addEventListener('alpine:init', () => {
    Alpine.data('imageCrop', (config = {}) => ({
        aspect: config.aspect ?? null,
        preview: config.preview ?? '',
        open: false,
        cropper: null,
        pick(event) {
            const file = event.target.files?.[0];
            if (!file) {
                return;
            }
            const url = URL.createObjectURL(file);
            this.open = true;
            this.$nextTick(() => {
                const img = this.$refs.cropImg;
                if (this.cropper) {
                    this.cropper.destroy();
                }
                img.src = url;
                this.cropper = new Cropper(img, {
                    aspectRatio: this.aspect || NaN,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            });
        },
        apply() {
            if (!this.cropper) {
                return;
            }
            const canvas = this.cropper.getCroppedCanvas({ maxWidth: 2400, maxHeight: 2400 });
            this.preview = canvas.toDataURL('image/jpeg', 0.92);
            this.$refs.data.value = this.preview;
            this.cropper.destroy();
            this.cropper = null;
            this.open = false;
        },
    }));
});

window.Alpine = Alpine;
Alpine.start();
