<?php

Class ProcessFile {

    public function go() {
        $filePath = $_FILES['file']['tmp_name'];
        $fileLines = file($filePath, FILE_IGNORE_NEW_LINES);

        if ($fileLines) {
            $lineCount = count($fileLines);
            $subtitleNum = 1;
            $currentBlock = '';
            $cleanStr = '';
            $cleanStrWithTimeStamps = '';
            $meaningfulTextCount = 0;

            for ($i = 0; $i < $lineCount; $i++) {
                $currentLine = preg_replace('/[^\x20-\x7E]/', '', $fileLines[$i]);
                $currentLine = strip_tags($currentLine);

                if ($subtitleNum === (int) $currentLine) {
                    // paragraphs are blindly split up here
                    $splitVal = (isset($_GET['sliderVal']) && $_GET['sliderVal']) ? $_GET['sliderVal'] : 30;

                    if ($meaningfulTextCount % $splitVal === 0) { // 40 for prod
                        $cleanStr .= $currentBlock;
                        $cleanStrWithTimeStamps .= $currentBlock;
                        $currentBlock = '';
                        $timeStamp = $this->formatTimestamp($fileLines[$i + 1]);

                        $br = $subtitleNum === 1 ? '' : '<br><br>';

                        // save timestamp for the start of this block
                        $cleanStrWithTimeStamps .= $br . $timeStamp . '<br>';
                        $cleanStr .= $br;
                    }

                    // skip to next content
                    $subtitleNum++;
                    $i = $i + 1;
                    continue;
                }

                if (!$currentLine) continue;

                $currentBlock .= ' ' . $currentLine;
                $meaningfulTextCount++;
            }

            // pickup leftovers
            $cleanStr .= $currentBlock;
            $cleanStrWithTimeStamps .= $currentBlock;

            return [
                'timestampStr' => $cleanStrWithTimeStamps,
                'cleanStr' => $cleanStr
            ];
        }

        return 'Problems.... text simon @ 6572822679';
    }

    public function formatTimestamp($str) {
        return substr($str, 0, 8);
    }
}

