<x-admin.layout>
    <x-slot:title>予約カレンダー</x-slot:title>

    <div class = "navigation">
        <a href="?date={{$prevWeek}}">◀前の週</a>
        <a href="?date={{$nextWeek}}">次の週▶</a>
    </div>
    <table>
        <thead>
            <th>時間</th>

        </thead>
    </table>
</x-admin.layout>