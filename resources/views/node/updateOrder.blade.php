<x-layout>
    <div class="contentArea">
        <div class="TextImage">
            <a href="{{ route('node.index', $node) }}" class="Button color-border-white size-large">
                <span class="material-icons back-icon">arrow_back</span>
                Return to Parent Node
            </a>
        </div>
    </div>
    <section class="Intro custom-nav">
        <div class="Intro--inner">
            <div class="Intro--top">
                <h1 class="Intro--title richtext">Edit Node Order</h1>
            </div>
        </div>
    </section>
    <section class="ContentArea">
        <form class="js-Form Form" action="{{ route('node.update-order.submit', $node) }}" method="POST">
            @csrf
            <div class="Form--header">
                <h2 class="Form--title">
                    Edit the order of the nodes
                </h2>
            </div>
            <div class="order-container">
                <div>
                    @for ($i = 1; $i <= count($node->children); $i++)
                        <p class="LinkList--text order-index">
                            {{ $i }}.
                        </p>
                    @endfor
                </div>
                <div id="order" class="order-name">
                    @foreach ($node->children as $childNode)
                        <div class="node-order-card">
                            <input type="hidden" name="order[]" value="{{ $childNode->id }}">
                            <span class="LinkList--text order-name-span">
                                {{ $childNode->name }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="FormButtons">
                <a href="{{ route('node.index', $node) }}" class="Button color-border-white size-large">
                    <span class="Button--inner">
                        Cancel
                    </span>
                </a>
                <button class="Button color-primary size-large" type="submit">
                    <span class="Button--inner">
                        Update Order
                    </span>
                </button>
            </div>
        </form>
    </section>
</x-layout>
<script src="{{ asset('sortable/Sortable.min.js') }}"></script>
<script>
    $draggable = $('#order')[0]
    new Sortable($draggable, {
        animation: 150,
    });
</script>
