#########################################################
#
# Prisma Welcome
#
# Based on Manjaro-welcome project by Philip Müller
#
# Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
# Last Edit: 07-08-2014
# Version: 0.1
#
#########################################################

pkgname=prisma-welcome
pkgver=0.1
pkgrel=1
pkgdesc="The Prisma Welcome utility provides a simple interface for accessing all the relevant information for a new user of Prisma."
arch=(any)
url="https://github.com/prismamec/prisma-welcome"
license=('GPL')
depends=('python-simplejson' 'python-gobject' 'pywebkitgtk')
options=(!emptydirs)

## Git release
source=(git+http://github.org/prismamec/prisma-welcome.git)
sha256sums=('SKIP')

package() {
    if [ -e "$srcdir/core-$pkgname" ]; then
        cd "$srcdir/core-$pkgname/src"
    else
        cd "$srcdir/$pkgname/src"
    fi

    mkdir -p "${pkgdir}/usr/share/${pkgname}"
    mkdir -p "${pkgdir}/usr/share/icons/hicolor"
    cp  -a data/* "${pkgdir}/usr/share/${pkgname}"
    touch "${pkgdir}/usr/share/${pkgname}/index.html"
    chmod 666 "${pkgdir}/usr/share/${pkgname}/index.html"
    install -D -m644 ${pkgname}.desktop ${pkgdir}/etc/skel/.config/autostart/${pkgname}.desktop
    install -D -m644 ${pkgname}.desktop ${pkgdir}/usr/share/applications/${pkgname}.desktop
    install -D -m755 "${pkgname}" "${pkgdir}/usr/bin/${pkgname}"
    install -D -m755 "${pkgname}-terminal" "${pkgdir}/usr/bin/${pkgname}-terminal"

}
