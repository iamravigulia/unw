<style>
    table {
        background: #fff;
        width: 100%;
        border: 0;
    }
    th {}
    td {
        border-top: 1px solid #999;
        padding: 5px;
    }
    tr:nth-child(odd) {
        background: #ddd;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<table class="cell-border" id="fmt_fillupmulti_index" style="width:100%">
    <thead>
        <th>#</th>
        <th>Question</th>
        <th>Answers</th>
        <th>Created at</th>
        <th>Updated at</th>
    </thead>
    <tbody>
        @php
        $fmt_unw_ques = DB::table('fmt_unjumble_words_ques')->get();
        @endphp
        @foreach ($fmt_unw_ques as $que)
        <tr>
            <td>{{$que->id}}</td>
            <td>{{$que->question}}</td>
            <td>
                @php $fmt_mof_ans = DB::table('fmt_unjumble_words_ans')->where('question_id', $que->id)->orderby('arrange','asc')->get() @endphp
                <ul>
                    @foreach ($fmt_mof_ans as $ans)
                        @if($ans->arrange == 0)
                        @else
                        <li>{{$ans->answer}}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
            <td>{{date('F d, Y',strtotime($que->created_at))}}</td>
            <td>{{date('F d, Y',strtotime($que->updated_at))}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
<script>
    $('#fmt_fillupmulti_index').dataTable( {
        "paging": true
    });
</script>