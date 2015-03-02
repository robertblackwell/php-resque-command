To run these simple tests do the following (after making the phar):

1.  open two terminal sessions
2.  in both cd to test directory
3.  in one session enter ./start_worker.sh and watch the resque server log its start up messsages
4.  in the other enter submitTest.php
5.  in the session running the resque server you should see the two job classes report on their actions.

Done