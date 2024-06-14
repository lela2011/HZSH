<x-iframe-layout>
    <h2 class="TextImage--title richtext">
        @foreach ($parents as $parent)
            <a class="nav-anchor" href="{{ route('node.iframe', ['node' => $parent, 'lang' => $lang == 'de' ? 'de' : 'en']) }}">
                {{ $lang == "de" ? $parent->name : $parent->name_en }}
            </a>
            /
        @endforeach
        {{ $lang == "de" ? $node->name : $node->name_en }}
    </h2>
    <div class="TextImage--inner">
        <div class="TextImage--content richtext">
            @if ($node->body)
                {!! $lang == "de" ? $node->body : $node->body_en !!}
            @endif
            <p>
                @foreach ($node->children as $child)
                    <a href="{{ route('node.iframe', ['node' => $child, 'lang' => $lang == 'de' ? 'de' : 'en']) }}">
                        {{ $lang == "de" ? $child->name : $child->name_en }}
                    </a>
                    @if (!$loop->last)
                        <br>
                    @endif
                @endforeach
            </p>
            @if ($node->info)
                <div class="info-card">
                    <div class="info-card--title">
                        <h2>ⓘ</h2>
                        <h2> Info</h2>
                    </div>
                    <div class="info-card--content @if ($node->children->count() == 0) expanded @endif">
                        {!! $lang == "de" ? $node->info : $node->info_en !!}
                    </div>
                </div>
            @endif
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
