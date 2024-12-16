export function initializeImageUpload() {
    const imageInput = document.getElementById('images');
    if (imageInput) {
        imageInput.addEventListener('change', handleImageSelection);
    }
}

function handleImageSelection(event) {
    const container = document.getElementById('image-preview-container');
    const files = event.target.files;

    for (const file of files) {
        if (file.size > 2 * 1024 * 1024) { // 2MB limit
            alert(`File ${file.name} is too large. Maximum size is 2MB.`);
            continue;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'relative group';

            previewWrapper.innerHTML = `
                <div class="relative aspect-w-1 aspect-h-1">
                    <img src="${e.target.result}"
                         class="object-cover w-full h-48 rounded-lg border border-gray-200"
                         alt="Preview">
                    <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                        <button type="button"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2"
                                onclick="this.closest('.relative').remove()">
                            Remove
                        </button>
                    </div>
                </div>
            `;

            container.appendChild(previewWrapper);
        };
        reader.readAsDataURL(file);
    }
}
