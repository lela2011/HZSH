<x-iframe-layout>
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                ID
            </th>
            <th>
                Iframe URL DE
            </th>
            <th>
                Iframe URL EN
            </th>
        </tr>
        @foreach ($rootNodes as $node)
            <tr>
                <td>
                    {{ $node->name }}
                </td>
                <td>
                    {{ $node->id }}
                </td>
                <td>
                    <a href="{{ route('node.iframe', ['node' => $node, 'lang' => 'de']) }}">
                        {{ route('node.iframe', ['node' => $node, 'lang' => 'de']) }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('node.iframe', ['node' => $node, 'lang' => 'en']) }}">
                        {{ route('node.iframe', ['node' => $node, 'lang' => 'en']) }}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</x-iframe-layout>
