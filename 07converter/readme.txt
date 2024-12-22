<!DOCTYPE html>
<html>
<head>
    <title>Simple Converter</title>
    <style>
        /* Minimal styling */
        body {
            font-family: Arial;
            margin: 20px;
        }
        .section {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ddd;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin: 10px 0;
        }
        button {
            padding: 5px 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .output {
            margin-top: 10px;
            padding: 10px;
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Simple Converter</h1>

    <div class="section">
        <h2>1. JSON to Object</h2>
        <textarea id="jsonInput">{"name": "John", "age": 30}</textarea>
        <button onclick="convertJson()">Convert</button>
        <div id="jsonOutput" class="output"></div>
    </div>

    <div class="section">
        <h2>2. JSON Date</h2>
        <textarea id="dateInput">{"date": "2024-03-20"}</textarea>
        <button onclick="convertDate()">Convert</button>
        <div id="dateOutput" class="output"></div>
    </div>

    <div class="section">
        <h2>3. JSON ↔ CSV</h2>
        <textarea id="dataInput">[{"name":"John","age":30},{"name":"Jane","age":25}]</textarea>
        <button onclick="jsonToCsv()">To CSV</button>
        <button onclick="csvToJson()">To JSON</button>
        <div id="convertOutput" class="output"></div>
    </div>

    <div class="section">
        <h2>4. String to Hash</h2>
        <input type="text" id="hashInput" value="Hello World">
        <button onclick="createHash()">Hash</button>
        <div id="hashOutput" class="output"></div>
    </div>

    <script>
        // 1. JSON to Object
        function convertJson() {
            try {
                let obj = JSON.parse(document.getElementById('jsonInput').value);
                document.getElementById('jsonOutput').innerText = 
                    JSON.stringify(obj, null, 2);
            } catch(e) {
                document.getElementById('jsonOutput').innerText = 'Invalid JSON';
            }
        }

        // 2. JSON Date
        function convertDate() {
            try {
                let obj = JSON.parse(document.getElementById('dateInput').value);
                let date = new Date(obj.date);
                document.getElementById('dateOutput').innerText = date.toString();
            } catch(e) {
                document.getElementById('dateOutput').innerText = 'Invalid Date';
            }
        }

        // 3. JSON ↔ CSV
        function jsonToCsv() {
            try {
                let arr = JSON.parse(document.getElementById('dataInput').value);
                let headers = Object.keys(arr[0]);
                let csv = [
                    headers.join(','),
                    ...arr.map(row => headers.map(h => row[h]).join(','))
                ].join('\n');
                document.getElementById('convertOutput').innerText = csv;
            } catch(e) {
                document.getElementById('convertOutput').innerText = 'Invalid JSON';
            }
        }

        function csvToJson() {
            try {
                let csv = document.getElementById('dataInput').value;
                let lines = csv.split('\n');
                let headers = lines[0].split(',');
                let result = lines.slice(1).map(line => {
                    let obj = {};
                    line.split(',').forEach((val, i) => obj[headers[i]] = val);
                    return obj;
                });
                document.getElementById('convertOutput').innerText = 
                    JSON.stringify(result, null, 2);
            } catch(e) {
                document.getElementById('convertOutput').innerText = 'Invalid CSV';
            }
        }

        // 4. String to Hash (using browser's crypto)
        function createHash() {
            let text = document.getElementById('hashInput').value;
            let encoder = new TextEncoder();
            let data = encoder.encode(text);
            crypto.subtle.digest('SHA-256', data).then(hash => {
                let hashArray = Array.from(new Uint8Array(hash));
                let hashHex = hashArray.map(b => 
                    b.toString(16).padStart(2, '0')).join('');
                document.getElementById('hashOutput').innerText = hashHex;
            });
        }
    </script>
</body>
</html>