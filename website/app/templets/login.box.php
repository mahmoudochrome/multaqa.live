<div class="box justify-center text-center items-center">
    <h2 class="text-2xl">Let's Have Fun!</h2>
    <form action="/login/" method="post">
        <input type="text" name="username" placeholder="username" maxlength="50">
        <input type="password" id="pwd" name="password" placeholder="password" maxlength="50">
        <div class="checkbox" id="chkbx">
            <input type="checkbox" id="showpwd" name="showpwd">
            <lable for="showpwd">
                show password
            </lable>
        </div>
        <submit>Login</submit>
    </form>
    <a href="/Signup/">Create an account</a>
</div>

<script src="/scripts/pwd.show.js"></script>