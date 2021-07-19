# PHP-Framework
> A small, PHP 8, composer-less (although composer is supported) powered micro framework 
> that uses an MVC architecture and services to help delegate relatively proper application 
> flow. Included is a PSR-3 logger, a REST'ful router, a treasure trove of services and procedural 
> functions to access the core framework and easily interchangeable service components. Plus
> a plethora of exception classes that extend PHP's native `\Exception` SPL's [[view package](https://github.com/jason-napolitano/PHP-Exceptions)].

## WIKI
### Installation:
Simply drag n' drop. Point your host to the `public` directory and vua-la! If you're running the
framework in a development environment, you can easily use `php -S locahost:PORT_#` to serve
the application. Don't forget to add a `.htaccess` file if you're running on an Apache server.

### Usage:
#### `.env`
A Dotenv service has been included within the framework [[see original source](https://github.com/codeigniter4/CodeIgniter4/blob/develop/system/Config/DotEnv.php)], 
to make working with `.env` files a breeze.  The system will start off by looking for a `.env.ENVIRONMENT` file to load 
values from, where the environment is the value of the `ENVIRONMENT` constant, located in `app/System/Constants.php`.

If that file is not present, the framework simply will not load any file at all and continue to
operate normally. When this is the case, you are encouraged to use the `App\Config\App` file to store 
your configuration values.

#### Services:
This framework relies heavily on the use of Services. In a nutshell, a service is
basically a set of instructions that can be swapped out, with ease. In this case, the framework
has the `App\Config\Services` container that holds all of your custom service methods. This class
overrides the existing `Core\Services\Container` to allow for easy method overriding of system
built service methods.

```
TBD
```
## License
MIT License

Copyright (c) 2021 Jason Napolitano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

