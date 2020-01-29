@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../cakephp/cakephp/lib/Cake/Console/cake
bash "%BIN_TARGET%" %*
