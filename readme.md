# Brvmedia

Use HLS to convert and encode video

## Installation

Via Composer

``` bash
$ composer require phobrv/brvmedia
```

## Package FFMPEG_Compiler_Script

https://github.com/Nicklas373/FFMPEG_Compiler_Script

### Install FFmpeg

#### Follow the instructions below
https://linuxconfig.org/install-ffmpeg-on-ubuntu-18-04-bionic-beaver-linux

#### x265 re-install
https://trac.ffmpeg.org/wiki/CompilationGuide/Ubuntu 

```bash
sudo apt-get install libnuma-dev && \
cd ~/ffmpeg_sources && \
wget -O x265.tar.bz2 https://bitbucket.org/multicoreware/x265_git/get/master.tar.bz2 && \
tar xjvf x265.tar.bz2 && \
cd multicoreware*/build/linux && \
PATH="$HOME/bin:$PATH" cmake -G "Unix Makefiles" -DCMAKE_INSTALL_PREFIX="$HOME/ffmpeg_build" -DENABLE_SHARED=off ../../source && \
PATH="$HOME/bin:$PATH" make && \
make install
```

#### Now re-login or run the following command for your current shell session to recognize the new ffmpeg location:

```bash
source ~/.profile
```
### Link

```
https://trac.ffmpeg.org/wiki/CompilationGuide/Ubuntu
https://kipalog.com/posts/Chong-download-file-video-tren-web-co-ban-bang-HLS--ket-hop-voi-Laravel
https://linuxconfig.org/install-ffmpeg-on-ubuntu-18-04-bionic-beaver-linux
https://github.com/Nicklas373/FFMPEG_Compiler_Script
https://github.com/protonemedia/laravel-ffmpeg 
```

