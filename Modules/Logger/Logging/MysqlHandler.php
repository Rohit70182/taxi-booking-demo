<?php

namespace Modules\Logger\Logging;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class MysqlHandler extends AbstractProcessingHandler
{
    protected $table;
    protected $connection;

    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        $this->table      = env('DB_LOG_TABLE', 'error_logs');
        $this->connection = env('DB_LOG_CONNECTION', env('DB_CONNECTION', 'mysql'));

        parent::__construct($level, $bubble);
    }


    protected function write(array $record): void
    {

        $data = [
            'instance'    => gethostname(),
            'message'     => $record['message'],
            'channel'     => $record['channel'],
            'level'       => $record['level'],
            'level_name'  => $record['level_name'],
            'error_line'  => isset($record['context']['exception']) ? $record['context']['exception']->getLine() : null,
            'file'        => isset($record['context']['exception']) ? $record['context']['exception']->getFile() : 'File Unknown',
            'trace'       => isset($record['context']['exception']) ? $record['context']['exception']->getTraceAsString() : 'Trace Unknown',
            'formatted_context' => $record['formatted'],
            'remote_addr' => isset($_SERVER['REMOTE_ADDR'])     ? ip2long($_SERVER['REMOTE_ADDR']) : null,
            'user_agent'  => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']      : null,
            'created_by'  => Auth::id() > 0 ? Auth::id() : null,
            'created_at'  => $record['datetime']->format('Y-m-d H:i:s')
        ];

        if (DB::connection()) {
            DB::connection($this->connection)->table($this->table)->insert($data);
        }
    }
}
