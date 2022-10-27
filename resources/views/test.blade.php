<base href="{{asset("")}}">

<form action="test" method="post">
    @csrf
    <input type="checkbox" name="check[]" id=""value="1">
    <input type="checkbox" name="check[]" id=""value="2">
    <input type="checkbox" name="check[]" id=""value="3">
    <input type="checkbox" name="check[]" id=""value="4">
    <input type="checkbox" name="check[]" id=""value="5">
    <input type="checkbox" name="check[]" id=""value="6">
    <input type="checkbox" name="check[]" id=""value="7">
    <input type="checkbox" name="check[]" id=""value="8">
    <button type="submit">Check</button>
</form>