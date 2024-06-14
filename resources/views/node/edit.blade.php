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
                <h1 class="Intro--title richtext">Edit the Node {{ $node->name }}</h1>
            </div>
        </div>
    </section>
    <div class="contentArea">
        <form class="Form js-Form" method="POST" action="{{ route('node.update', $node) }}">
            @csrf
            <div class="Form--body">
                <div class="FormInput">
                    <label class="FormLabel" for="name">
                        Name
                    </label>
                    <input class="Input" id="name" name="name" value="{{ old('name', $node->name) }}">
                    @error('name')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="name_en">
                        Name English
                    </label>
                    <input class="Input" id="name_en" name="name_en" value="{{ old('name_en', $node->name_en) }}">
                    @error('name_en')
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
                    <textarea class="Input wysiwyg" name="body" id="body">{{ old('body', $node->body) }}</textarea>
                    @error('body')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="body_en">
                        Body English
                    </label>
                    <textarea class="Input wysiwyg" name="body_en" id="body_en">{{ old('body_en', $node->body_en) }}</textarea>
                    @error('body_en')
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
                    <textarea class="Input wysiwyg" name="info" id="info">{{ old('info', $node->info) }}</textarea>
                    @error('info')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormInput">
                    <label class="FormLabel" for="info_en">
                        Info English
                    </label>
                    <textarea class="Input wysiwyg" name="info_en" id="info_en">{{ old('info_en', $node->info_en) }}</textarea>
                    @error('info_en')
                    <p class="has-error" style="color: red">
                        <small>
                            {{$message}}
                        </small>
                    </p>
                    @enderror
                </div>
                <div class="FormButtons">
                    <a href="{{ route('node.index', $node->parent) }}" class="Button color-border-white size-large">
                        <span class="Button--inner">
                            Cancel
                        </span>
                    </a>
                    <button class="Button color-primary size-large" type="submit">
                        <span class="Button--inner">
                            Update
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
