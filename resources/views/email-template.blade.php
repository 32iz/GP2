<div class="container" style="padding: 1rem; background: #f5f5f5;">
    <h1> Hi There! </h1>

    <p> There is a new order for you: </p>
    @foreach ($subcategory as $subcategory)
        <h3> {{ $subcategory->name }} </h3>
    @endforeach

    <p> Here is the customer details: </p>
    @foreach ($user as $user)
        <p>Customer Name: {{ $user->name }} </p>
        <p>Customer Email: {{ $user->email }} </p>
    @endforeach

</div>