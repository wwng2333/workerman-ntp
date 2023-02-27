# workerman-ntp

NTP server powered by workerman

Powered by [Workerman](https://github.com/walkor/workerman) and [NTPLite](https://github.com/majetzx/ntplite)

# Install
## Debian 11
```bash
apt install php7.4-cli composer git
git clone https://github.com/wwng2333/workerman-ntp.git
cd generate_204
composer install
php ntp.php start -d
```
## Alpine Linux 3.18
```bash
apk add git composer php81-cli php81-posix php81-pcntl
git clone https://github.com/wwng2333/workerman-ntp.git
cd generate_204
composer install
php ntp.php start -d
```


# License
LGPL 2.1 , according to NTPLite.
