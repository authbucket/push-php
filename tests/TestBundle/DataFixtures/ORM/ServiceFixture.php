<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\DataFixtures\ORM;

use AuthBucket\Push\Tests\TestBundle\Entity\Service;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Service();
        $model->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setServiceType('apns')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOption([
                'host' => 'ssl://gateway.sandbox.push.apple.com:2195',
                'local_cert' => <<<EOF
-----BEGIN CERTIFICATE-----
MIIFmzCCBIOgAwIBAgIIR9URu/EXwHgwDQYJKoZIhvcNAQEFBQAwgZYxCzAJBgNV
BAYTAlVTMRMwEQYDVQQKDApBcHBsZSBJbmMuMSwwKgYDVQQLDCNBcHBsZSBXb3Js
ZHdpZGUgRGV2ZWxvcGVyIFJlbGF0aW9uczFEMEIGA1UEAww7QXBwbGUgV29ybGR3
aWRlIERldmVsb3BlciBSZWxhdGlvbnMgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkw
HhcNMTUxMDAyMDMzMjU4WhcNMTYxMDAxMDMzMjU4WjCBmjErMCkGCgmSJomT8ixk
AQEMG2NvbS5hdXRoYnVja2V0LnB1c2gtY29yZG92YTFJMEcGA1UEAwxAQXBwbGUg
RGV2ZWxvcG1lbnQgSU9TIFB1c2ggU2VydmljZXM6IGNvbS5hdXRoYnVja2V0LnB1
c2gtY29yZG92YTETMBEGA1UECwwKVjUyOVhFUE1YVDELMAkGA1UEBhMCVVMwggEi
MA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDrqFwrWaX9QAro1Nx73We8bClY
WNsxKClgvlZk7Ct7MywF9mJgan48mBclax7CYO2v5GIp1pdStoEAh+jZp/fjJBOE
d+LsWNXPoWVlGeU33/6CsthSd+evFR9/Vlztk4/3pw4VVw1dOL2xdMRzIwh3gImc
2y+1f5G5cXi8sRcN4nEUyzMctOpmS38DFOLQPUNzhjc0PeHOEn4GIYVfn8V5/ENR
hhb62suU2FaZ4hmIasFFR+3Vfpgf9n4DzaEPePwSVXFwH1O9C37Umm24tYLU7SrB
DzqPYAuBwpTTTCPPy9+J+imqt8rx/XE+3hTG8z+UqYByE14iaV657bIzPwdBAgMB
AAGjggHlMIIB4TAdBgNVHQ4EFgQUN4iORq6c1tBlWAwIV/0pENwcANgwCQYDVR0T
BAIwADAfBgNVHSMEGDAWgBSIJxcJqbYYYIvs67r2R1nFUlSjtzCCAQ8GA1UdIASC
AQYwggECMIH/BgkqhkiG92NkBQEwgfEwgcMGCCsGAQUFBwICMIG2DIGzUmVsaWFu
Y2Ugb24gdGhpcyBjZXJ0aWZpY2F0ZSBieSBhbnkgcGFydHkgYXNzdW1lcyBhY2Nl
cHRhbmNlIG9mIHRoZSB0aGVuIGFwcGxpY2FibGUgc3RhbmRhcmQgdGVybXMgYW5k
IGNvbmRpdGlvbnMgb2YgdXNlLCBjZXJ0aWZpY2F0ZSBwb2xpY3kgYW5kIGNlcnRp
ZmljYXRpb24gcHJhY3RpY2Ugc3RhdGVtZW50cy4wKQYIKwYBBQUHAgEWHWh0dHA6
Ly93d3cuYXBwbGUuY29tL2FwcGxlY2EvME0GA1UdHwRGMEQwQqBAoD6GPGh0dHA6
Ly9kZXZlbG9wZXIuYXBwbGUuY29tL2NlcnRpZmljYXRpb25hdXRob3JpdHkvd3dk
cmNhLmNybDALBgNVHQ8EBAMCB4AwEwYDVR0lBAwwCgYIKwYBBQUHAwIwEAYKKoZI
hvdjZAYDAQQCBQAwDQYJKoZIhvcNAQEFBQADggEBAIL1CzGDaULYBMi7tWjknHhE
Ld9MuMadQHbvPBFCqQ7hJ1b4w9Xi9tMBaVm0eIV29evRXt4OLsBhCdUhPcNLgXeh
HatX3oHuCiThQoEZMOpO35wh0ZxCX5VTH7J/hhlHDyXL9TwOBtOJ0aciV/EGrRA6
KvLvjiddFhVo27OtbRFIIQA+4pHmQc1/z7t0Io+ArEypYVdDxR+QgoouVh7OM+Fs
iyZBLRaXBz0ivlyosiERAC/Bj4aciertdWaSjrBaV+rG/jj0mWNpbdtbdYs4yRMw
wx5Psn+NbLq+nkxhgTRfYV5/UuXu3GTAxPaXORj3ig0kAxdQA5mnu0+i09A/5WI=
-----END CERTIFICATE-----
Bag Attributes
    friendlyName: PantaRei Design
    localKeyID: 37 88 8E 46 AE 9C D6 D0 65 58 0C 08 57 FD 29 10 DC 1C 00 D8
Key Attributes: <No Attributes>
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: DES-EDE3-CBC,33DEC333D3450708

OrY/17n0+6VIudIfxgXNSIFZCYCjPwVTrsZpf2zlDCKpy8/xDpTYLCVGJO9lZedK
windxPMTJ4v5kKGiU93X73j6AjDSsVlSXDrqHmQEn7dCRQpS3MgAUmn3W8zu0s71
GPlZ3PDr+SigMSXx/VV/owvmFVpR9CaMeIjP2xE5iMT4jjhEq7q/DlwEW9u4GiZT
Vn6n30YLJEXDj7wNMpgpJnyDbOTPw0+hFAMj5XavVsruk3vZsJ6AU8fkHgfKT+mO
4ziJ20tKCoMIJzIoALZC50hMzMqroy6HQS1ODSsuvemi5uqp+Bqlw8lEhn0l7dEL
/MjUP0/NgbkCTnA07nfCUHmKSbPjbY8onrDz+d3k/mr9hZTINv1xTbQ8QEgKTd+I
jlrVq2BGlWmDSw+TXiUmdWHhkDRwnnCiVBFkreWj2wiO45srp4+/6TKHKeRdAHyD
FyK4q+ACZan+vPuSl3zTu27v3rqLEI/OHUqQZGP1LGUPZ/EOvBE7ILQLIeXjyvNe
DlJ7Gfc4bDFAmC4a5XX75olr9NBt783xfv7FRis2Qglfffe49myFghngM+9Bi0aq
ijQXYgSAzTWp2wKhXvOh5gKZzb4+MZJCNkbEY9K5v95YYpHGhaT0JUebDAuC4ctW
Xt4e20SexMMAG7VvSagpD45v104mL8o2A0N386GRKto7f2+iYWKHWJopNMdabknL
52UtF+RYPA4O3wDglYUi2v7KFky4Fpia8yfYIvXRVg9xq3yhABFBQOKb5Nk/tPkq
ccW/7lExG1VHarO1fzE5YXI5KX0Ky0CvIput0tYoDw9nJMTE7tx71wJoy228cXU+
lohamP8Fr3LwDj0RpriPolt4gsuTBkc6pwBGDBZSEPwn1M2HnrWtZSK4hgcLER6M
f6v3HdSV33BnTr9CkBqreZdglBguExaj20NknUV2JdD9TZmZe4yOrJBapDjUrb9P
ktsATAddN6fX1DOnweKdzgys2hxOcwNoKoCcQjla7Xa14LKUtGcUPBu595UYHSoO
UeYytxKr/tYlMcLmMEftiLPZMX7PkQazzahvRox44XSWZVlJION1jS2n9/p4wwJc
YXCaA9KFo8IBmGQ7CaqQeg0ZdQ1YLO0oQMGcduEr+IgXNqr7pSSNNmdmUTn/YdCy
AEJiou+Rpybidi7oS+/r8LaYw49ft31hv/+du2rSrjKs1FipsRNzweb8+GnWtyKk
krWfYkH0fWhocn1szp6tE94d7m8Bltk5yWOwqkn/dArWgOGlCi/Kr7/iydV7pUp4
4EwiN3zm+Ptk0cmTCQjZM3bUWuWDgHrYMaef0+beEQwaylLnSKhlTUM/wcZzWeLX
McRX2b/UKKrO1A49Lyq4TzvQrGJYodSFngUdZLQdmXGmI3+MXv4rOz5u46+Stznv
Kk1nKmdO6LCBO7+crDgwhWUbT7aP9Ty1O5C5aDV2XqcnHIygiNb3eWbUQ+wmkX57
ZU4d0obUD6NKMvNO+9UjdJ2K6DiGRbTRfJcYvQVTnOWMTrv+6fkG51z1Oo8gQL8W
P71yT7xX2pgsZyJ/UCS8tUCPy+xG9nAnHSJn6pKQblHzh3Kg99sj51oJ33y1UMpt
-----END RSA PRIVATE KEY-----
EOF
        ,
                'passphrase' => 'hello123',
            ]);
        $manager->persist($model);

        $model = new Service();
        $model->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setServiceType('gcm')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOption([
                'host' => 'https://gcm-http.googleapis.com/gcm/send',
                'key' => 'AIzaSyBAC26lw1thmvfhlaCE7BOr24WhmqoLuTU',
            ]);
        $manager->persist($model);

        $model = new Service();
        $model->setServiceId('58016ff14ad63b5987751c18600e88d9')
            ->setServiceType('apns')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOption([
                'host' => 'ssl://gateway.sandbox.push.apple.com:2195',
                'local_cert' => <<<EOF
Bag Attributes
    friendlyName: Apple Production IOS Push Services: hk.edu.polyucpce
    localKeyID: 8D 65 BB A2 42 54 CD B6 C6 29 E4 5D 2E 90 29 5C 47 16 7B DB
subject=/UID=hk.edu.polyucpce/CN=Apple Production IOS Push Services: hk.edu.polyucpce/OU=E5TG962G7J/C=US
issuer=/C=US/O=Apple Inc./OU=Apple Worldwide Developer Relations/CN=Apple Worldwide Developer Relations Certification Authority
-----BEGIN CERTIFICATE-----
MIIFhDCCBGygAwIBAgIIEqtR91lZc9EwDQYJKoZIhvcNAQEFBQAwgZYxCzAJBgNV
BAYTAlVTMRMwEQYDVQQKDApBcHBsZSBJbmMuMSwwKgYDVQQLDCNBcHBsZSBXb3Js
ZHdpZGUgRGV2ZWxvcGVyIFJlbGF0aW9uczFEMEIGA1UEAww7QXBwbGUgV29ybGR3
aWRlIERldmVsb3BlciBSZWxhdGlvbnMgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkw
HhcNMTUxMDAyMDQyNTUxWhcNMTYxMDAxMDQyNTUxWjCBgzEgMB4GCgmSJomT8ixk
AQEMEGhrLmVkdS5wb2x5dWNwY2UxPTA7BgNVBAMMNEFwcGxlIFByb2R1Y3Rpb24g
SU9TIFB1c2ggU2VydmljZXM6IGhrLmVkdS5wb2x5dWNwY2UxEzARBgNVBAsMCkU1
VEc5NjJHN0oxCzAJBgNVBAYTAlVTMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
CgKCAQEAwJo48+wtQaGnIheuXPHMz9SxcAHvtvFJBq52wSjrYjFZAA0QdhGZFbUd
oj7KwjScsWfhe1vJvQlzRqkFlDWlDLcld18ErmnhyrLVkQpS6fhD+30fdIIB3jfa
QoN0d9emIiicUMpMzWm1X9O9EESL9sPwzoDfHK7Y8yPV1HCaz7EcVGj+qgT5JtO5
14KV2Z23IBjGksSf1DMCby/NHrnrsEU/M4qSk8gUmHxf3/DWJLWggu2ZB7q9aU+4
GCw1/1vo/nBaa1TwA0fbnxY6dwUR2tLQPAkf0AlsRQ7CBaHOlid7b/wOhDU4Ada2
0AYYe7UeKyA0J6G4vFm2/GkeJPDJFQIDAQABo4IB5TCCAeEwHQYDVR0OBBYEFI1l
u6JCVM22xinkXS6QKVxHFnvbMAkGA1UdEwQCMAAwHwYDVR0jBBgwFoAUiCcXCam2
GGCL7Ou69kdZxVJUo7cwggEPBgNVHSAEggEGMIIBAjCB/wYJKoZIhvdjZAUBMIHx
MIHDBggrBgEFBQcCAjCBtgyBs1JlbGlhbmNlIG9uIHRoaXMgY2VydGlmaWNhdGUg
YnkgYW55IHBhcnR5IGFzc3VtZXMgYWNjZXB0YW5jZSBvZiB0aGUgdGhlbiBhcHBs
aWNhYmxlIHN0YW5kYXJkIHRlcm1zIGFuZCBjb25kaXRpb25zIG9mIHVzZSwgY2Vy
dGlmaWNhdGUgcG9saWN5IGFuZCBjZXJ0aWZpY2F0aW9uIHByYWN0aWNlIHN0YXRl
bWVudHMuMCkGCCsGAQUFBwIBFh1odHRwOi8vd3d3LmFwcGxlLmNvbS9hcHBsZWNh
LzBNBgNVHR8ERjBEMEKgQKA+hjxodHRwOi8vZGV2ZWxvcGVyLmFwcGxlLmNvbS9j
ZXJ0aWZpY2F0aW9uYXV0aG9yaXR5L3d3ZHJjYS5jcmwwCwYDVR0PBAQDAgeAMBMG
A1UdJQQMMAoGCCsGAQUFBwMCMBAGCiqGSIb3Y2QGAwIEAgUAMA0GCSqGSIb3DQEB
BQUAA4IBAQCX5OvCCTjTZQvXfQ3I1Kr0UVDIbYzQhd25zp6U8/5bApEJ7muvcWOp
4K6QeWByqYLctutTUNW+Kvs0GhfH7W+PdOslS4kEC81AHdsKSALJV2mBZACLzF/D
/X0WQ3A6dKJ26xP7cEPYafCqcIq4RsHSLGeFcqVviGWJlSL522/EOcent9w+Kpdp
0b5SqNNPl81Bbvz2Hd7EsTmO8w5lSgj26e/1DVDapPDVAEsfCFrplO9SPLjgQ8ph
bFTggh4X+Wxdq8QZxR25nWNYUk1qs7RVVDlgtfh9LC4e0279t53xdV+Ihk6ZiYle
FegTeKPmYBQXqrfId/P5ZuAq/oqXKY/M
-----END CERTIFICATE-----
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAwJo48+wtQaGnIheuXPHMz9SxcAHvtvFJBq52wSjrYjFZAA0Q
dhGZFbUdoj7KwjScsWfhe1vJvQlzRqkFlDWlDLcld18ErmnhyrLVkQpS6fhD+30f
dIIB3jfaQoN0d9emIiicUMpMzWm1X9O9EESL9sPwzoDfHK7Y8yPV1HCaz7EcVGj+
qgT5JtO514KV2Z23IBjGksSf1DMCby/NHrnrsEU/M4qSk8gUmHxf3/DWJLWggu2Z
B7q9aU+4GCw1/1vo/nBaa1TwA0fbnxY6dwUR2tLQPAkf0AlsRQ7CBaHOlid7b/wO
hDU4Ada20AYYe7UeKyA0J6G4vFm2/GkeJPDJFQIDAQABAoIBACmQXqANJMsYFphd
4ev+5oMnVE9mq5OgSHEfr1MKAJoFKj6/kwDX1WCA4G9F+72jWvlSAK/9Y/DenDjw
etq8JO00jOpQ4BK/mNGEfGA7iR8iy5D3NJWRBNQu23QlKDpAmIKgnvM0ZRSjLlgK
uq9LC6VqLYpy9zMabIkz/45D6rTNFNhSkVCzitak9Y6VBdeicS9xTO96FNaAvy6T
vMIyF8RdrMZeJhAp+54PbE5Ea7L18mD9A0gWIp0tXjUhGD3eDA6aWoH6co3y34Xv
xyUxkdPa9HxJi0e1FEDFPmFxV+tMngB3O4wP9XsvKuYECDFlBQ6rHvIqYXyw8AGi
mRgeyaECgYEA7F3mvooK5Xa1WE+NSUgSL+xo50VphTRP3CdblHIpeKtTEHKFWPEh
6bdUj3sNN3J/j2AYg4Y061N0MZfUb+YCEagr8hAjP5xjCmJfNJg4i/h6kc7Ov7Bz
DgkYZsWdtHUWCZ/Mk3BnSDL9LGXHeIc4BvtMMfGVXyE59yj5HWV+Gm0CgYEA0Jm3
a08BYT8jEMFhsoAge6x7rkVkJhJh7vVmN3HGhGNHj8qwCOuc2Xq0QHGedQ6tN/IG
gzH2SViYeRRiUeR0gUq/ZpgtNWGsTEo/uAmKRgjr53voQoYj4Y72tznd4nnAoxUJ
ahyOW1ephIdoBIP4VLeZZ7cjLnPIgkEwowbgQEkCgYAXICjPQ5pFURP1C/N60/5T
igHJftUQH0og9AjVwUWldL2vwkShqxXyU+mGEDf+0MkCMhiz5ZGP5J5dq8kxGYPi
Tl3eVQ3dz2MxROajsrD1oN39HgrEXnMjUGh+xZ7kZQA++M9/LWQtgC+dBGg7tp8Y
r8WIrWY75HhTYkLdSWzJEQKBgDVQdE6a3LFsH5wysLOch7DUPrAl0Bji7eDTG5Lk
I2bGsQ2RMji1b1suP0+ROnyUibUYyI1TgazxVdbsXMytZRF+dzjTgAp6sjy1ZV+2
IH8R3KlHQ+9stVL65RejVJCDqbaEs+lI7yFtYEgdC3rL9/Y/DpgxeG5w7ThNTQ79
vObxAoGAbDpz24XkA3AeZpHRbDFvFHUnKRntUfERXkwZLigcN6u1uShzcVcQ9Nb2
vtKnkytRfkkM46PCR3V3sbhebcGuem3v3OZLvedeimQTKw8Xs8+vU/knAQfY1Q0k
FxyTucK7iEgH42FMeVr0obNzZeNki+v+Eh6Fb5uqqptdBov5jOs=
-----END RSA PRIVATE KEY-----
EOF
        ,
                'passphrase' => '1234',
            ]);
        $manager->persist($model);

        $model = new Service();
        $model->setServiceId('3e79432001c247fba8eb7b8af2eb8aee')
            ->setServiceType('gcm')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOption([
                'host' => 'https://gcm-http.googleapis.com/gcm/send',
                'key' => 'AIzaSyBGKBQLSaHfDZPRYs85iVHnOd4MWE0OKG4',
            ]);
        $manager->persist($model);

        $manager->flush();
    }
}
