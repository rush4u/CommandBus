# CommandBus
Simple Command and Query Bus implementation for laravel

## How to use it?

### Creating Commands

Command is a simple php class which receives input, the command handler receives the command instance and performes some operation inside it, be it directly or by calling some service call that do the business logic.

Command handlers return void, if you want to return data use a Query Handler, keep reading.

#### Create the Command class

```php
<?php

namespace App\CommandBus\Cart;

use Rush4u\CommandBus\CommandInterface;

class RemoveItemFromCartCommand implements CommandInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
```

#### Create the Command Handler class

```php
<?php

namespace App\CommandBus\Cart;

use Rush4u\CommandBus\Command\CommandHandlerInterface;
use Rush4u\CommandBus\CommandInterface;

class RemoveItemFromCartCommandHandler implements CommandHandlerInterface
{
    public function __invoke(CommandInterface $command):void
    {
        //proceed with method logic or delegate to service call
    }
}
```

#### Invoke command from controller

```php
<?php

namespace App\Http\Controllers;

use App\CommandBus\Cart\RemoveItemFromCartCommand;
use App\CommandBus\Cart\RemoveItemFromCartCommandHandler;
use Rush4u\CommandBus\Command\CommandBusInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $queryBus;

    public function __construct(CommandBusInterface $queryBus)
    {
        $this->commandBus = $queryBus;
    }

    public function destroy($id)
    {
        $this->commandBus->dispatch(new RemoveItemFromCartCommand($id));
        
        session()->flash('success', 'The product was removed from your cart.');
        
        return redirect('/');
    }
}
```

### Creating Query Commands

A Query Command is a simple php class which receives input, the query handler receives the command instance and performes some data gathering inside it, the return the data inside associative array.

#### Create the Query Command class

```php
<?php

namespace App\CommandBus\Cart;

use Rush4u\CommandBus\CommandInterface;

class GetItemFromCartQuery implements CommandInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
```

#### Create the Query Handler class

```php
<?php

namespace App\CommandBus\Cart;

use Rush4u\CommandBus\Query\QueryHandlerInterface;
use Rush4u\CommandBus\CommandInterface;

class GetItemFromCartQueryHandler implements QueryHandlerInterface
{
    public function __invoke(CommandInterface $command)
    {
        //proceed with data gathering, return it in an array
    }
}
```

#### Invoke query from controller

```php
<?php

namespace App\Http\Controllers;

use App\CommandBus\Cart\GetItemFromCartQuery;
use App\CommandBus\Cart\GetItemFromCartQueryHandler;
use Rush4u\CommandBus\Query\QueryBusInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function destroy($id)
    {
        $data = $this->queryBus->dispatch(new GetItemFromCartCommand($id));
        
        return view('cart.find_item_partial, $data);
    }
}
```
