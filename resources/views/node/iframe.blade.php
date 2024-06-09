<x-iframe-layout>
    <h2 class="TextImage--title richtext">
        @foreach ($parents as $parent)
            <a class="nav-anchor" href="{{ route('node.iframe', $parent) }}">
                {{ $parent->name }}
            </a>
            /
        @endforeach
        {{ $node->name }}
    </h2>
    <div class="TextImage--inner">
        <div class="TextImage--content richtext">
            {!! $node->body !!}
            <p>
                @foreach ($node->children as $child)
                    <a href="{{ route('node.iframe', $child) }}">
                        {{ $child->name }}
                    </a>
                    @if (!$loop->last)
                        <br>
                    @endif
                @endforeach
            </p>
            <div class="info-card">
                <div class="info-card--title">
                    <h2>ⓘ</h2>
                    <h2> Info</h2>
                </div>
                <div class="info-card--content @if ($node->children->count() == 0) expanded @endif">
                    {!! $node->info !!}
                </div>
            </div>
        </div>
    </div>
</x-iframe-layout>
<script>
    $(function() {
        $(".info-card").click(function() {
            $(this).find(".info-card--content").toggleClass("expanded");
        });
    });
</script>
