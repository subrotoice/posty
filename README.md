## About Laravel
# Name Route
Route::get('/register', [RegisterController::class, 'index'])->name('register'); 
{{ route('register') }} // in any href="", could be contorlled centrally


# Password Confirmation validation
name="password"
name="password_confirmation "
$this->validate($request, [  
    'name' => 'required|max:255',
    'username' => 'required|max:255',
    'email' => 'required|max:255|email',
    'password' => 'required|confirmed'
]);

# Store method in controller in differnet ways
Precess1: 
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'address' => 'required'
        ]);
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')
        ->with('success','Company has been created successfully.');
}

Process2:
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'price' => 'required|integer',
        'description' => 'required'
    ]);
    Product::create($data);
    
    // Another way of doing Save
    // $product = new Product;
    // $product->name = $request->name;
    // $product->price = $request->price;
    // $product->description = $request->description;
    // $product->save();

    return redirect()->route('products.index');
}

#Migration 
#add columns to existing table
php artisan make:migration add_columns_to_users_table

Schema::table('users', function (Blueprint $table) {
    $table->string('username')->after('name');  // just after name colum in users table
});

Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('username');
});

# Authontication
auth()->attempt($request->only('email', 'password'));  // after store and login in RegisterController
#Way of checking
@if(auth()->user())   // you can use auth()->check() also but same
    <li>
        <a href="" class="p-3">Alex Garrett-Smith</a>
    </li>
    <li>
        <a href="" class="p-3">Logout</a>
    </li>
@else
    <li>
        <a href="" class="p-3">Login</a>
    </li>
    <li>
        <a href="{{ route('register') }}" class="p-3">Register</a> 
    </li>
@endif
//Better way of doing checking
@auth
    <li>
        <a href="" class="p-3">Alex Garrett-Smith</a>
    </li>
    <li>
        <a href="" class="p-3">Logout</a>
    </li>
@endauth
@guest
    <li>
        <a href="" class="p-3">Login</a>
    </li>
    <li>
        <a href="{{ route('register') }}" class="p-3">Register</a> 
    </li>
@endguest

# LoginController
if(!auth()->attempt($request->only('email', 'password'), $request->remember)) { // remember password
    return back()->with('status', 'Invalid Email Password');
};
- In login.blade.php
<input type="checkbox" name="remember" id="remember" class="mr-2">
<label for="remember">Remember me</label>

#logout best code Hack free
<form action="{{ route('logout') }}" method="post"> // if you give link it can manupulate using javascript
    @csrf
    <button class="p-3">Logout</button>
</form>
- In logout controller
public function store()
{
    auth()->logout();
    return redirect()->route('home');
}

- Without authenticatoin no access to Dashboard or like this url
Process1:
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Process2:
public function __construct()  // in DashboardController, You can user both Process together
{
    $this->middleware('auth');
}
- If Login then can not access login page or register page, not make sense
In LoginController and In RegisterController
public function __construct() // By doing so we can access index() & store() if not guest, or not login
{
    $this->middleware('guest');
}

#Pagination
// $posts = Post::get();  // Get all the results
$posts = Post::paginate(2);
{{ $posts->links() }} // In blade template

# Faker, Dami data
public function definition()   // In PostFactory
{
    return [
        'body' => $this->faker->sentence(20),
    ];
}

php artisan timker    // in Command Line
App\Models\Post::factory()->times(200)->create(['user_id' => 4]);