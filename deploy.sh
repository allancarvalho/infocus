#!/bin/bash
echo "Executing push on github";
cd application/config/;
cp database.php database.php.temp;
cp database.phpprod database.php;
git commit -m "autodeploy";
cd ../..;
git push; 

echo "Executing deploy on FTP";
git ftp push;

cd application/config/;
mv database.php.temp database.php;

cd ../..;

echo "deploy ended";

echo "exiting...";
