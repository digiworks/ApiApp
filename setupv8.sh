#!/bin/bash
# Install required dependencies
sudo apt install build-essential curl git python libglib2.0-dev php php-dev php-intl php-curl php-mbstring php-bcmath php-common php-pgsql php-mysql php-bz2 php-gd

cd /tmp

# Install depot_tools first (needed for source checkout)
git clone https://chromium.googlesource.com/chromium/tools/depot_tools.git
export PATH=`pwd`/depot_tools:"$PATH"

# Download v8
fetch v8
cd v8

# (optional) If you'd like to build a certain version:
git checkout 8.0.426.30
gclient sync

# Setup GN
tools/dev/v8gen.py -vv x64.release -- is_component_build=true use_custom_libcxx=false

# Build
ninja -C out.gn/x64.release/

# Install to /opt/v8/
sudo mkdir -p /opt/v8/{lib,include}
sudo cp out.gn/x64.release/lib*.so out.gn/x64.release/*_blob.bin \
  out.gn/x64.release/icudtl.dat /opt/v8/lib/
sudo cp -R include/* /opt/v8/include/



sudo apt-get install patchelf
for A in /opt/v8/lib/*.so; do sudo patchelf --set-rpath '$ORIGIN' $A; done


cd /tmp
git clone https://github.com/phpv8/v8js.git
cd v8js
phpize
./configure --with-v8js=/opt/v8 LDFLAGS="-lstdc++" CPPFLAGS="-DV8_COMPRESS_POINTERS"
make
make test
sudo make install
