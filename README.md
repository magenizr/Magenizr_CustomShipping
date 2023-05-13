[![Magenizr Plus](https://images2.imgbox.com/11/6b/yVOOloaA_o.gif)](https://account.magenizr.com)
---

# Custom Shipping
This Magento 2 module allows you to provide a custom shipping method in backend only, frontend only or both. With the `Scheduler` feature you can manage the availability automatically. In the following screenshots you can see an example `Christmas Special - Fix Price` for `$9.90`.

![Magenizr CustomShipping - Backend](https://images2.imgbox.com/8a/d1/vngOHsq3_o.gif)

## Installation (Composer 2)

1. Update your composer.json `composer require "magenizr/magento2-customshipping":"1.0.2" --no-update`
2. Use `composer update magenizr/magento2-customshipping --no-install` to update your composer.lock file.

```
Updating dependencies
Lock file operations: 1 install, 1 update, 0 removals
  - Locking magenizr/magento2-customshipping (1.0.2)
```

3. And then `composer install` to install the package.

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 1 install, 0 update, 0 removals
  - Installing magenizr/magento2-customshipping (1.0.2): Extracting archive
```

4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_CustomShipping --clear-static-content
```

## Installation (Manually)
1. Download the latest version of the source code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_CustomShipping_1.0.2.tar.gz`.
3. Copy the code into `./app/code/Magenizr/CustomShipping/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_CustomShipping --clear-static-content
```

## Features
* The option `Backend`, `Frontend` or `Backend / Frontend` allows you hide or display the custom shipping method in frontend or backend.
* The option `Customer` allows you to display the custom shipping method for logged in customers only.
* With `Scheduler` you can manage the availability automatically by using the `Start Date` or `End Date` field.
* `Frequency` allows you to enable the custom shipping method on specific weekdays only.
* With `Hide Other Shipping Methods` you can disable other shipping methods if Custom Shipping is available.
* Customizable `Method Name` and `Method Title`.
* Customizable `Price`. Default is `0.00`.

## Usage
The functionality can be used in the backend section `Stores > Configuration > Sales > Shipping Methods > Custom Shipping`.

## Support
If you have any issues with this extension, open an issue on [Github](https://github.com/magenizr/Magenizr_CustomShipping/issues).

## History
===== 1.0.2 =====
* Cleanup to meet coding standards (EQP, ECG)
* Remove framework constraints in composer.json

===== 1.0.1 =====
* Magento 2.4.x compatibility added
* i18n added
* Minor updates

===== 1.0.0 =====
* Stable version
* Code based on latest version of [https://github.com/tobias-forkel/Magento2_CustomShipping](https://github.com/tobias-forkel/Magento2_CustomShipping)

## License
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)
