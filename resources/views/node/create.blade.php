<x-layout>
    @if ($node)
        <div class="contentArea">
            <div class="TextImage">
                <a href="{{ route('node.index', $node->parent) }}" class="Button color-border-white size-large">
                    <span class="material-icons back-icon">arrow_back</span>
                    Return to @if ($node->parent) Parent Node @else Root @endif
                </a>
            </div>
        </div>
    @endif
    <section class="Intro @if ($node) custom-nav @endif">
        <div class="Intro--inner">
            <div class="Intro--top">
                <h1 class="Intro--title richtext">Create a new Node</h1>
            </div>
        </div>
    </section>
    <div class="contentArea">
        <form class="Form js-Form" method="POST" action="{{ route('node.store', $node) }}">
            @csrf
            <div class="Form--body">
                <div class="FormInput">
                    <label class="FormLabel" for="name">
                        Name
                    </label>
                    <input class="Input" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="body">
                        Body
                    </label>
                    <textarea class="Input wysiwyg" name="body" id="body">{{ old('body') }}</textarea>
                    @error('body')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="info">
                        Info
                    </label>
                    <textarea class="Input wysiwyg" name="info" id="info">{{ old('info') }}</textarea>
                    @error('info')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormButtons">
                    <a href="{{ route('node.index', $node) }}" class="Button color-border-white size-large">
                        <span class="Button--inner">
                            Cancel
                        </span>
                    </a>
                    <button class="Button color-primary size-large" type="submit">
                        <span class="Button--inner">
                            Create
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
