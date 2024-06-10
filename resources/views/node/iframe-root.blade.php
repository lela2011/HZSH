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
                Iframe URL
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
                    <a href="{{ route('node.iframe', $node) }}">
                        {{ route('node.iframe', $node) }}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</x-iframe-layout>
