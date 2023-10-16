#run .\create.ps1

$folderName = Read-Host "Enter the name of the block you want to create"
$folderPath = Join-Path -Path $PSScriptRoot -ChildPath $folderName
New-Item -ItemType Directory -Path $folderPath

$scssFilePath = Join-Path -Path $folderPath -ChildPath "$folderName.scss"
New-Item -ItemType File -Path $scssFilePath
Add-Content -Path $scssFilePath -Value "@import '../../scss/variables';
@import '../../scss/mixins';
@import '../../scss/mixins/breakpoints';

.block-$folderName {
}
"

$cssFilePath = Join-Path -Path $folderPath -ChildPath "$folderName.css"
New-Item -ItemType File -Path $cssFilePath
Add-Content -Path $cssFilePath -Value ""

$phpFilePath = Join-Path -Path $folderPath -ChildPath "$folderName.php"
New-Item -ItemType File -Path $phpFilePath
Add-Content -Path $phpFilePath -Value ""

$jsonFilePath = Join-Path -Path $folderPath -ChildPath "block.json"
New-Item -ItemType File -Path $jsonFilePath
Add-Content -Path $jsonFilePath -Value "
{
    ""name"": ""acf/$folderName"",
    ""title"": ""$folderName"",
    ""description"": """",
    ""style"": [ ""file:./$folderName.css"" ],
    ""category"": ""layout"",
    ""icon"": ""block-default"",
    ""acf"": {
        ""mode"": ""preview"",
        ""renderTemplate"": ""$folderName.php""
    },
    ""supports"": {
        ""align"": true,
        ""anchor"": true,
        ""alignContent"": true,
        ""color"": {
            ""text"": true,
            ""background"": true,
            ""link"": true
        },
        ""alignText"": true,
        ""spacing"": {
            ""margin"": [
                ""top"",
                ""bottom""
            ],
            ""padding"": true
        },
        ""typography"": {
            ""lineHeight"": true,
            ""fontSize"": true
        },
        ""fullHeight"": true
    },
    ""styles"": [
        { ""name"": ""default"", ""label"": ""Default"", ""isDefault"": true },
        { ""name"": ""red"", ""label"": ""Red"" },
        { ""name"": ""green"", ""label"": ""Green"" },
        { ""name"": ""blue"", ""label"": ""Blue"" }
    ]
}
"

$blocksFilePath = Join-Path -Path $PSScriptRoot -ChildPath "blocks.php "
(Get-Content $blocksFilePath) | ForEach-Object {
    if ($_ -match "^// end of file") {
        $_ -replace "(^.+$)", "`$1`t`r`n// Folder Name: $folderName"
    } else {
        $_
    }
} | Set-Content $blocksFilePath

$blocksFilePath = Join-Path -Path $PSScriptRoot -ChildPath "blocks.php"
$content = Get-Content $blocksFilePath
$content[8] += "`r`nregister_block_type( __DIR__ . '/$folderName' ); "
Set-Content $blocksFilePath $content