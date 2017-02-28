<?php

namespace Phambinh\Cms\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class EnvSet extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'env:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set an environmental value.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $line = $this->argument('line');

        list($variable, $value) = explode('=', $line, 2);
        $data = $this->read();
        array_set($data, $variable, $value);
        $this->write($data);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['line', InputArgument::REQUIRED, 'The line to update.'],
        ];
    }

    private function read()
    {
        $data = [];

        if (!file_exists($env = base_path('.env'))) {
            return $data;
        }
        
        $content = explode("\n", file_get_contents($env));

        foreach ($contents as $line) {
            // Check for # comments.
            if (starts_with($line, '#')) {
                $data[] = $line;
            } elseif (strpos($line, '=')) {
                list($key, $value) = explode('=', $line);

                $data[$key] = $value;
            }
        }

        return $data;
    }

    private function write($data)
    {
        $contents = '';

        foreach ($data as $key => $value) {
            if ($key) {
                $contents .= strtoupper($key) . '=' . $value . PHP_EOL;
            } else {
                $contents .= $value . PHP_EOL;
            }
        }

        file_put_contents(base_path('.env'), $contents);
    }
}
