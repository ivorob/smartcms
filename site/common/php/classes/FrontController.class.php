<?php

class FrontController {
    public function doRequest($context, $request, $response) {
        $response->addXmlContent($context->options());

        $command = $this->getCommand($request);
        return $command->handleCommand($context, $response);
    }

    private function getCommand($request) {
        $commandClass = $this->getCommandClass($request);
        $command = new $commandClass($request);
        if (!$command) {
            throw new Exception("Can't load class: " . $classname);
        }

        return $command;
    }

    private function getCommandClass($request) {
        $index = $this->getParamIndex("command");
        $command = $request->getParameter($index);
        if (empty($command)) {
            $command = 'main';
        }

        $classname = ucfirst($command) . "Command";
        return $classname;
    }

    private function getParamIndex($name) {
        $index = -1;
        switch ($name) {
            case "command":
                $index = 0;
                break;
            default:
                throw new Exception("Can't get param index for name: " . $name);
                break;
        }

        return $index;
    }
};

