<x-layout>
    <section class="Intro">
        <div class="Intro--inner">
            <div class="Intro--top">
                <h1 class="Intro--title richtext">
                    Login in to Manage the HZSH Database
                </h1>
            </div>
        </div>
    </section>
    <section class="ContentArea">
        <form class="Form js-Form" method="POST" action="{{route('authenticate')}}">
            @csrf <!-- Prevents cross site scripting attacks -->
            <div class="Form--body">
                <div class="FormInput">
                    <label class="FormLabel" for="username">
                        Username
                    </label>
                    <input type="text" class="Input" name="username" value="{{old('username')}}" autocomplete="username"/>
                    @error('username')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="password">
                        Password
                    </label>
                    <input type="password" class="Input" name="password" autocomplete="current-password"/>
                    @error('password')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormButtons">
                    <button class="Button color-primary size-large" type="submit">
                        <span class="Button--inner">
                            Login
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </section>
</x-layout>
