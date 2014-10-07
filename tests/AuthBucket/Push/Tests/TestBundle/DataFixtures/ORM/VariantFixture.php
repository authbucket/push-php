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

use AuthBucket\Push\Tests\TestBundle\Entity\Variant;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VariantFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Variant();
        $model->setVariantId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setVariantSecret('51d819733baf585b424483da6383841e')
            ->setVariantType('apns')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOptions(array(
                'host' => 'ssl://gateway.sandbox.push.apple.com:2195',
                'local_cert' => <<<EOF
-----BEGIN CERTIFICATE-----
MIIFmzCCBIOgAwIBAgIIEK8htRc6Pt4wDQYJKoZIhvcNAQEFBQAwgZYxCzAJBgNV
BAYTAlVTMRMwEQYDVQQKDApBcHBsZSBJbmMuMSwwKgYDVQQLDCNBcHBsZSBXb3Js
ZHdpZGUgRGV2ZWxvcGVyIFJlbGF0aW9uczFEMEIGA1UEAww7QXBwbGUgV29ybGR3
aWRlIERldmVsb3BlciBSZWxhdGlvbnMgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkw
HhcNMTQwOTA5MTI0NzM1WhcNMTUwOTA5MTI0NzM1WjCBmjErMCkGCgmSJomT8ixk
AQEMG2NvbS5hdXRoYnVja2V0LnB1c2gtY29yZG92YTFJMEcGA1UEAwxAQXBwbGUg
RGV2ZWxvcG1lbnQgSU9TIFB1c2ggU2VydmljZXM6IGNvbS5hdXRoYnVja2V0LnB1
c2gtY29yZG92YTETMBEGA1UECwwKVjUyOVhFUE1YVDELMAkGA1UEBhMCSEswggEi
MA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDOTXFoGLlApApLbDjQWIPdpE7Q
3f2+ojaX6m1p4np3EvsBha3MSI2svFxIgUEAqqCZRmJfING/1kPWCT8uw9capS3b
88atrFdKLxtestIpUN/8Uh/KlL39NFjo4K4Q9A+Jg7rI4eUvIcCPwV5JNzu/NKAJ
whAaOc1zc025wcnU4x9WhMqLHzqMcp1XVuS+t/TZTQWIYVKPvCkbH2bVNlupLEWw
g2kyjYLRSDNFXSkqQQE9F1wVr7heu8pvYODljI+nS5muSr+9QL1xDsOlLwLXsG8m
QERuMBDQo5htw22ANeSLAJCuCXfQkFZPiFIwb4R9TYqh3tNpROvp8y4JdPB9AgMB
AAGjggHlMIIB4TAdBgNVHQ4EFgQU1qBTCpZSTz0YAcbJopMI7ddhGn8wCQYDVR0T
BAIwADAfBgNVHSMEGDAWgBSIJxcJqbYYYIvs67r2R1nFUlSjtzCCAQ8GA1UdIASC
AQYwggECMIH/BgkqhkiG92NkBQEwgfEwgcMGCCsGAQUFBwICMIG2DIGzUmVsaWFu
Y2Ugb24gdGhpcyBjZXJ0aWZpY2F0ZSBieSBhbnkgcGFydHkgYXNzdW1lcyBhY2Nl
cHRhbmNlIG9mIHRoZSB0aGVuIGFwcGxpY2FibGUgc3RhbmRhcmQgdGVybXMgYW5k
IGNvbmRpdGlvbnMgb2YgdXNlLCBjZXJ0aWZpY2F0ZSBwb2xpY3kgYW5kIGNlcnRp
ZmljYXRpb24gcHJhY3RpY2Ugc3RhdGVtZW50cy4wKQYIKwYBBQUHAgEWHWh0dHA6
Ly93d3cuYXBwbGUuY29tL2FwcGxlY2EvME0GA1UdHwRGMEQwQqBAoD6GPGh0dHA6
Ly9kZXZlbG9wZXIuYXBwbGUuY29tL2NlcnRpZmljYXRpb25hdXRob3JpdHkvd3dk
cmNhLmNybDALBgNVHQ8EBAMCB4AwEwYDVR0lBAwwCgYIKwYBBQUHAwIwEAYKKoZI
hvdjZAYDAQQCBQAwDQYJKoZIhvcNAQEFBQADggEBAL74/xJhFYFG+8cg/7GktMko
XaX7Ed01z57y0BxaRsPjhtt9c2chj9nON6SNznaxrDk7pM0jvVDWlI4zPTh5cv5V
hNe/rJoQivkgpEwghyb77gGnpI+mxJgZu3QCB3otBA43uRsHSBcqFD77thviCsM8
Y9g3iv9CURhQQJWGbyZg3EJiRQGmzvrRWoerNbNaALmAxALz+abMdevA3Mh2zZe5
rTStuKUkYMm0GFly7GTgHnkEh2GdeKF9+POUJ309TDi0K81EkVK5F12G39sugE2g
BXskD0MVbXgKXVqFdr9DZ/WIIGhryH/vlgc92K64u8edHOqqi7Fay4oHVBKjIoA=
-----END CERTIFICATE-----
Bag Attributes
    friendlyName: PushPluginDemo
    localKeyID: D6 A0 53 0A 96 52 4F 3D 18 01 C6 C9 A2 93 08 ED D7 61 1A 7F
Key Attributes: <No Attributes>
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: DES-EDE3-CBC,3D63E52C053D0409

Fg6DlFBe8JrQoiamfB1mBskUu5JrJYw+aMSADbvnBDZOAZ6yvsVCXo1RzGzA5R1f
gZ5lQ8dD2BTaNNS0QBhnaYdMUoE3VfTvEdEvr9nLjWzoVfcJo6DFVMj+7y9Xlm+s
0tTS7GlzoN2D0Jqt/tct/1TbjYkXOGCXlFXeicjtWGpG8vC2vkAaw+bNXmHfW0KG
7hgsrmMkHIVUqcWBcDORWqUmJdoLVtWKQTQqmm1yHuNznz7MehibxdZFszRXUH+k
/vVUSmj6prf0GoME6QsSKG4pUvkLJ8XoZgyZbNFwTWd8Upr01DjHfSBZvqcynpA5
6J3yW6pn1+dRMleuc0E6q0+h7d5WTpilLf4DIA2f+ckrIud8u3fwAINZsvocUZSc
ZDpIXgyY/Dfgg16TMWkYWHhOYac7ckdBBLzgeultCArQrOWTuI0PwmFQ/yjaiepA
F1DSvgFpsFpzcKeYJwrNGOaId2VY52+L9+mgdyngkUi1TnvQgd/MAzZketNN9337
sDrRl9YfOFEm/bbHzufSbidIVzzYJ8OJwTR6D4zAT7fOwtExs2MibGu1bF9ZiZno
ZWWxo0noqcCjaDGH/Aw6OQcuFbPDa64aarTvICDbue04ZWrTPI3vRPN9OBQcCMsG
oiQKTgcCG5JsfVNpC+3qM7fcrjprUHWeuGihZWc99bC/A3hFzgVsi7wwjy7/DJod
Y6/6wniT8aHilGvLjIyBcTHIyuVMdx2csLUzrMjAWqxuKMCg5LsWYfEFMxk0ybfy
sSjRYPuAhHm+5eLPLko7K7nF8rwTe/sq8vLfABD7lDh7ZA6nCK5RSuDdhVv+O0xR
2qP6EKgI/VF55OtZONhanuqQKo+SGYPc25IEMGC3lh6zfsvNJSJzWN3c8gpe01Yn
nMiJWpWcBCrhT+ME1+etC5FQQEgZsfsUOQ8YwMgC9WdEoCqs9SCu+PrNTDnWYMXN
v3v5xN3qw2zDlTco4M82TM8i7USmnCaAinMl4VrTUmEXD1ca2/QUfjGm57xkd+Rv
G61CU/yzFv8v5BwKmxXPgsbhvp8gmMhex4Fnw0QE5bxCOuO/nY9ib6rdau17GsDU
7ow6/P5AW2zEuwwCMFzCKK+av2SXFRmpTGkCXUW0P5zEf1zFNLcwTEkrSN6dJRv5
i4dxWU1KPsxN3jjGYLeQgo/dP0lzsya5YN4nG/4N89t6Ktk+1fY8oz6zg7n2kvjq
HDqqkUH6PKAAi1K22AgkT3AHghr6nQ5eL4P2qDoaG6r3NBY9tUWpXTE2yAwGjnXc
f16uJmEwi8A830vdv9CA8vNk6R6jKzu7ikTUZDuIjy38xVnDlG8V5wkzkFxvjp2p
BZekm62R/7i/NmIwNp0kQXT9q39WLSTj78MsvzwObHh5ghsmKjWWyxAb1/mPRS97
Y2oBW/nnZBaOiObuyWnMQNc1ogGhixJ4+GDawT2qCJsNr30vm1xexTxgzeXIhJow
yU1XJwWyzCb9OjilJzcRCkUqx0UwEe1Vn1uSKp+XdQRBhTknMYikPSU4+wVuQ5HN
9gcPDaMG4+eY2dFA0FrMB0fQj8kUKTyMQvwzv0nM6+pM22kiuPYOuYlUIPRaU7Qr
-----END RSA PRIVATE KEY-----
EOF
        ,
                'passphrase' => 'hello123',
            ));
        $manager->persist($model);

        $model = new Variant();
        $model->setVariantId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setVariantSecret('1c21c3f8a4ecba1703a6fbaf322587f6')
            ->setVariantType('gcm')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setOptions(array(
                'host' => 'https://android.googleapis.com/gcm/send',
                'key' => 'AIzaSyAWV2gTtvIYIwg-Bgo_TI0w5EEEjQUJh_0',
            ));
        $manager->persist($model);

        $manager->flush();
    }
}
