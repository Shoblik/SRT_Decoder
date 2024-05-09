<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SRT Decoder</title>
    <meta name="author" content="Simon Hoblik">
    <meta name="description" content="Free and secure srt to text decoder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./resources/index.js"></script>
    <link href="./resources/app.css" rel="stylesheet">
</head>
    <body>
        <div class="top-bar">
            <h2>Secure SRT File Decoder</h2>
            <label for="file" class="standard-btn">
                Upload File
            </label>
            <input class="standard-btn" type="file" name="file" id="file" onchange="fileSubmit.submit()"><br><br>
            <div class="controls">
                <label for="range">Control the frequency of paragraphs and timestamps:</label>
                <input type="range" min="1" max="150" value="30" id="slider" onchange="fileSubmit.submit();" />
            </div>
        </div>
        <div id="processedFileTargetContainer">
            <p class="file-name"></p>
            <div class="left">
                <h3>Transcript:</h3>
                <button class="standard-btn" onclick="copyButtons.clicked('#clean');">Copy</button>
                <p id="cleanFeedback" class="copy-feedback"></p>
                <p class="content-target" id="clean"></p>
            </div>
            <div class="right">
                <h3>Transcript with Timestamps:</h3>
                <button class="standard-btn" onclick="copyButtons.clicked('#timestampClean')">Copy</button>
                <p id="timestampCleanFeedback" class="copy-feedback"></p>
                <p class="content-target" id="timestampClean"></p>
            </div>
        </div>
    </body>
</html>