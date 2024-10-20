<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Compressor Tool</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%);
        }

        .container {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        img {
            max-width: 400px;
            max-height: 400px;
            margin: 20px auto;
            display: block;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
        }

        input[type="file"] {
            display: none;
        }

        label {
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        label:hover {
            background-color: #45a049;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Image Compressor Tool</h1>
        <label for="fileInput">Choose Image</label>
        <input type="file" id="fileInput" accept="image/*">
        <div id="previewContainer" class="hidden">
            <img id="previewImage" src="#" alt="Preview">
            <div id="sizeInfo"></div>
            <button id="compressButton">Compress Image</button>
        </div>
    </div>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const image = document.getElementById('previewImage');
                    image.src = e.target.result;
                    document.getElementById('previewContainer').classList.remove('hidden');
                    document.getElementById('compressButton').style.display = '';
                    document.getElementById('sizeInfo').innerHTML = '';
                    document.getElementById('downloadButton').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('compressButton').addEventListener('click', function() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'compressor.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        document.getElementById('sizeInfo').innerHTML = `<p>Original Size: ${response.originalSize}</p><p>Compressed Size: ${response.compressedSize}</p>`;
                        const downloadLink = document.createElement('a');
                        downloadLink.href = response.downloadLink;
                        downloadLink.download = 'compressed_image.jpg';
                        downloadLink.innerHTML = '<button id="downloadButton">Download Compressed Image</button>';
                        document.getElementById('sizeInfo').appendChild(downloadLink);
                        document.getElementById('compressButton').style.display = 'none';
                    }
                };
                xhr.send(formData);
            }
        });
    </script>
</body>
</html>
