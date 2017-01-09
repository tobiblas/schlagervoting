import os
import subprocess
from tempfile import mkstemp
from shutil import move
from os import remove, close

################# APACHE2 ####################################

print "Checking for apache installation..."

apache2path = subprocess.Popen("which apache2", shell=True, stdout=subprocess.PIPE).stdout.read()

if "apache2" not in apache2path:
    print "installing apache web server (might take a while..)"
    print subprocess.Popen("sudo apt-get install apache2 -y", shell=True, stdout=subprocess.PIPE).stdout.read()
else:
    print "apache already installed. Skipping"
    print "-----------"

################# PHP ########################################

print "Checking for php installation..."

phpPath = subprocess.Popen("which php", shell=True, stdout=subprocess.PIPE).stdout.read()

if "php" not in phpPath:
    print "installing php  (might take a while..)"
    print subprocess.Popen("sudo apt-get install php5 libapache2-mod-php5 -y", shell=True, stdout=subprocess.PIPE).stdout.read()
else:
    print "php already installed. Skipping"

print "-----------"

################# SQLITE3 ########################################

print "Checking for sqlite3 installation..."

phpPath = subprocess.Popen("which sqlite3", shell=True, stdout=subprocess.PIPE).stdout.read()

if "sqlite3" not in phpPath:
    print "installing sqlite3  (might take a while..)"
    print subprocess.Popen("sudo apt-get install sqlite3 -y", shell=True, stdout=subprocess.PIPE).stdout.read()
else:
    print "sqlite3 already installed. Skipping"

# create temp.db

#CREATE TABLE TEMP(
#                  ...>     timestamp DATETIME DEFAULT CURRENT_TIMESTAMP PRIMARY KEY,
#                  ...>     temp REAL,
#                           location TEXT
#                  ...> );

print "-----------"

################# MOVE PHP PAGE TO RIGHT PLACE ###############

print "installing php pages in /var/www/html/"

print subprocess.Popen("sudo mkdir -p /var/www/html/mello && sudo cp -R php/* /var/www/html/mello", shell=True, stdout=subprocess.PIPE).stdout.read()

print "-----------"


##############################################################

print
print "Congratulation! All done."
