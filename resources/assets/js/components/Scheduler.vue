<template>
    <div class="panel panel-default">
        <h1>Scheduler</h1>
        <div id="wrapper">
            <div id="myScheduler"></div>
        </div>
    </div>
</template>
<style>
    body{
        /*background-color:#ff0000;*/
    }
    /* hey i have change sth */
    /* please update */
</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        ready(){
            YUI().use(
                    'aui-scheduler',
                    function(Y) {
                        var events = [
                            {
                                content: 'Partial Lunar Eclipse',
                                endDate: new Date(2013, 3, 25, 5),
                                startDate: new Date(2013, 3, 25, 1)
                            }
                        ];

                        var agendaView = new Y.SchedulerAgendaView();
                        var dayView = new Y.SchedulerDayView();
                        var weekView = new Y.SchedulerWeekView();
                        var monthView = new Y.SchedulerMonthView();

                        new Y.Scheduler(
                                {
                                    activeView: weekView,
                                    boundingBox: '#myScheduler',
                                    date: new Date(2013, 3, 25),
                                    items: events,
                                    render: true,
                                    views: [dayView, weekView, monthView, agendaView]
                                }
                        );
                    }
            );
        }
    }
</script>
