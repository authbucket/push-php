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
                'host' => 'https://android.googleapis.com/gcm/send',
                'key' => 'AIzaSyBAC26lw1thmvfhlaCE7BOr24WhmqoLuTU',
            ]);
        $manager->persist($model);

        $manager->flush();
    }
}
