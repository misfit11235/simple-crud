@echo off
php.exe -q -C -dshort_open_tag=1 %~dp0\phptags %*
