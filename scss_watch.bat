
set dir=%~dp0
set cssDir=%~dp0trunk\

cd %cssDir%
sass --watch css:css --style compact
