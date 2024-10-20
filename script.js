const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const previewContainer = document.getElementById('previewContainer');
const previewImage = document.getElementById('previewImage');
const sizeInfo = document.getElementById('sizeInfo');
const compressButton = document.getElementById('compressButton');
const downloadLink = document.getElementById('downloadLink');

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#2ecc71';
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.style.borderColor = '#3498db';
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#3498db';
    handleFile(e.dataTransfer.files[0]);
});

fileInput.addEventListener('change', (e) => {
    handleFile(e.target.files[0]);
});

compressButton.addEventListener('click', compressImage);

function handleFile(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
            compressButton.style.display = '';
            sizeInfo.innerHTML = `Original Size: ${formatSize(file.size)}`;
            downloadLink.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function compressImage() {
    const img = new Image();
    img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        const scaleFactor = 0.7;
        canvas.width = img.width * scaleFactor;
        canvas.height = img.height * scaleFactor;

        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        canvas.toBlob((blob) => {
            const compressedSize = blob.size;
            sizeInfo.innerHTML += `<br>Compressed Size: ${formatSize(compressedSize)}`;
            
            const url = URL.createObjectURL(blob);
            downloadLink.href = url;
            downloadLink.classList.remove('hidden');
            compressButton.style.display = 'none';
        }, 'image/jpeg', 0.7);
    };
    img.src = previewImage.src;
}

function formatSize(bytes) {
    if (bytes >= 1048576) {
        return (bytes / 1048576).toFixed(2) + ' MB';
    } else if (bytes >= 1024) {
        return (bytes / 1024).toFixed(2) + ' KB';
    } else if (bytes > 1) {
        return bytes + ' bytes';
    } else if (bytes === 1) {
        return bytes + ' byte';
    } else {
        return '0 bytes';
    }
}
