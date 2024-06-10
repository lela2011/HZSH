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
                <h1 class="Intro--title richtext">Delete Node {{ $node->name }}</h1>
            </div>
        </div>
    </section>
    <div class="contentArea">
        <div class="TextImage">
            <h2 class="TextImage--title richtext">
                To be deleted Node: {{ $node->name }}
            </h2>
            <div class="TextImage--inner">
                <div class="TextImage--content richtext">
                    <h3>Name:</h3>
                    <p class="richtext">
                        {{ $node->name }}
                    </p>
                    <h3>Body:</h3>
                    <p>
                        {!! $node->body !!}
                    </p>
                    <h3>Info:</h3>
                    <p>
                        {!! $node->info !!}
                    </p>
                </div>
            </div>
        </div>
        <form class="Form js-Form" method="POST" action="{{ route('node.destroy', $node) }}">
            @csrf
            <div class="Form--body">
                <div class="FormInput">
                    <label class="FormLabel" for="confirmationForm">
                        Confirmation
                    </label>
                    <div class="Options js-OptionInput" id="confirmationForm">
                        <div class="OptionInput">
                            <input type="checkbox" id="confirmation" value="1" name="confirmation">
                            <label for="confirmation">
                                I confirm that I want to delete this node and all its children.
                            </label>
                        </div>
                        @error('confirmation')
                        <p class="has-error" style="color: red">
                            <small>
                                {{$message}}
                            </small>
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="FormButtons">
                    <a href="{{ route('node.index', $node->parent) }}" class="Button color-border-white size-large">
                        <span class="Button--inner">
                            Cancel
                        </span>
                    </a>
                    <button class="Button color-primary size-large" type="submit">
                        <span class="Button--inner">
                            Delete
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
