<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Hashing & Integrity Check</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .section h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #3498db;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            margin-bottom: 15px;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #f0f8ff;
            border-left: 4px solid #3498db;
        }
        
        .result h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .result p {
            word-break: break-all;
            font-family: monospace;
            font-size: 14px;
            background-color: #f1f1f1;
            padding: 8px;
            border-radius: 4px;
        }
        
        .success {
            background-color: #e8f5e9;
            border-left: 4px solid #2ecc71;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        
        .error {
            background-color: #ffebee;
            border-left: 4px solid #e74c3c;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .icon {
            margin-right: 8px;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>File Hashing & Integrity Check</h1>
            <p class="subtitle">Verify file integrity with SHA-256 hash generation and verification</p>
        </header>

        <div class="section">
            <h2>📥 Generate Hash</h2>
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file-hash">Select File:</label>
                    <input type="file" id="file-hash" name="file" required>
                </div>
                <input type="hidden" name="action" value="hash">
                <button type="submit">Generate Hash</button>
            </form>
        </div>

        <div class="section">
            <h2>🔍 Verify Integrity</h2>
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file-verify">Select File to Verify:</label>
                    <input type="file" id="file-verify" name="file" required>
                </div>
                <div class="form-group">
                    <label for="input-hash">Original Hash Value:</label>
                    <input type="text" id="input-hash" name="input_hash" placeholder="Paste the original SHA-256 hash here" required>
                </div>
                <input type="hidden" name="action" value="verify">
                <button type="submit">Verify Integrity</button>
            </form>
        </div>

        <!-- This section would be dynamically generated by the PHP script -->
        <?php if (isset($new_hash)): ?>
        <div class="result">
            <h3>Hash Result:</h3>
            <p><?php echo $new_hash; ?></p>
            
            <?php if ($new_hash === $_POST["input_hash"]): ?>
            <div class="success">
                <p>✅ File integrity verified! The file has not been modified.</p>
            </div>
            <?php else: ?>
            <div class="error">
                <p>❌ File integrity check failed! The file may have been tampered with.</p>
            </div>
            <?php endif; ?>
            
            <a href="index.php" class="back-link">← Return to Hash Generator</a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>