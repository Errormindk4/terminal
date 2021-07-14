#Test task

##Installation commands:

- `git clone https://github.com/Errormindk4/terminal.git`
- `cd terminal`
- `composer install`
- `cp .env.example .env` 
- `php artisan key:generate`
- `php artisan test`

##Terminal implementation

All new classes placed in the `app\Services` directory

Pricing data stored in the tests `tests\Unit\ExampleTest.php` as the array of objects. 
This file also contains test cases from your example 


### Pricing format:

Array of Objects keyed by code
```php
<?php
    $pricing = ['A' => (Object) [
       'name' => 'Product A',
       'price' => (Object) [
           'amount' => 2,
           'pax' => 5,
           'tax' => 10,
           'pax_amount' => 9
       ]
    ]];
?>
```
Each Object contain price with parameters:
- amount (Price value)
- tax (Tax value)
- ?pax (Count of pax to get special price)
- ?pax_amount (Special price if pax scanned)
- ?depend_code (Product code; have to be scanned to get current for free)

### Terminal Usage

```php
<?php
    use App\Services\Terminal;
    
    //------------------
    
    $pricing = [...];

    $terminal = new Terminal($pricing);
    
    $terminal->scanProduct('A');
    
    $total = $terminal->calcTotal();
?> 
```

## For tests

Run 
``php artisan test`` 
