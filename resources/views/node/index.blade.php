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
                <h1 class="Intro--title richtext">Nodes</h1>
            </div>
        </div>
    </section>
    <div class="contentArea">
        @if ($node)
            <div class="TextImage">
                <h2 class="TextImage--title richtext">
                    Current Node: {{ $node->name }}
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
            <div class="TextImage">
                <hr>
            </div>
        @endif
        <div class="TextImage">
            @if ($node)
                <h2 class="TextImage--title richtext">
                    Child Nodes:
                </h2>
            @endif
            <div class="container">
                <a class="card" href="{{ route('node.create', $node) }}">
                    <img class="card-image" src="{{ asset('images/add.svg') }}" alt="add button" />
                </a>
                @foreach ($childNodes as $childNode)
                    <div class="card">
                        <a class="content" href="{{ route('node.index', $childNode) }}">
                            <div class="TextImage--content richtext">
                                <p class="card-content">
                                    {{ $childNode->name }}
                                </p>
                            </div>
                        </a>
                        <div class="horizontal-divider"></div>
                        <div class="quick-action-container">
                            <a class="quick-action edit" href="{{ route('node.edit', $childNode) }}">
                                <span class="material-icons">edit</span>
                                Edit
                            </a>
                            <div class="vertical-divider"></div>
                            <a class="quick-action delete" href="{{ route('node.delete', $childNode) }}">
                                <span class="material-icons">delete</span>
                                Delete
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($node)
                <div class="bottom-link">
                    <a href="{{ route('node.update-order', $node) }}" class="Button color-border-white size-large">
                        Update Order
                        <span class="material-icons forward-icon">arrow_forward</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>
