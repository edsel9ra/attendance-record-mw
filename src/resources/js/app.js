import '../css/app.css';

import SignaturePad from 'signature_pad';

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('signatureCanvas');
    if (!canvas) return;

    const signatureInput = document.getElementById('signatureInput');
    const clearBtn = document.getElementById('clearSignature');
    const form = document.getElementById('attendanceForm');
    const placeholder = document.getElementById('signaturePlaceholder');
    const statusEl = document.getElementById('signatureStatus');

    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = rect.width * ratio;
        canvas.height = rect.height * ratio;
        const ctx = canvas.getContext('2d');
        ctx.scale(ratio, ratio);
        signaturePad && signaturePad.clear();
    }

    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgba(0,0,0,0)',
        penColor: '#0a1628',
        minWidth: 1,
        maxWidth: 2.5,
    });

    function updateUI() {
        const isEmpty = signaturePad.isEmpty();
        if (placeholder) {
            placeholder.style.opacity = isEmpty ? '1' : '0';
        }
        if (statusEl) {
            statusEl.textContent = isEmpty ? '' : `Firma registrada (${signaturePad.toData().length} puntos)`;
        }
        clearBtn.disabled = isEmpty;
    }

    canvas.addEventListener('pointerdown', updateUI);
    canvas.addEventListener('pointerup', updateUI);
    signaturePad.addEventListener('endStroke', updateUI);

    clearBtn.addEventListener('click', () => {
        signaturePad.clear();
        signatureInput.value = '';
        updateUI();
    });

    form.addEventListener('submit', (e) => {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            if (statusEl) {
                statusEl.textContent = 'Debe dibujar su firma antes de enviar';
                statusEl.classList.add('text-red-500');
                setTimeout(() => {
                    statusEl.classList.remove('text-red-500');
                }, 3000);
            }
            canvas.parentElement.classList.add('border-red-400', 'ring-2', 'ring-red-200');
            setTimeout(() => {
                canvas.parentElement.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
            }, 2000);
            return;
        }
        signatureInput.value = signaturePad.toDataURL();
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<span class="inline-flex items-center gap-2"><svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Registrando...</span>';
    });

    const ro = new ResizeObserver(() => resizeCanvas());
    ro.observe(canvas);

    updateUI();
});
