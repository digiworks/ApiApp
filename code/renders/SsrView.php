<?php
namespace code\renders;


class SsrView extends Loader
{
    private $buffered;
    private $scriptClient;
    private $scriptServer;
    
    public function __construct($ssrFile, $scriptC = null, $scriptS = null) {
        $this->addPart($ssrFile);
        $this->buffered = $this->load();
        $this->scriptClient = $scriptC;
        $this->scriptServer = $scriptS;
    }
    
    /**
     * 
     * @param string $script
     * @return $this
     */
    public function setScriptClient($script)
    {
        $this->scriptClient = $script;
        return $this;
    }
    /**
     * 
     * @param string $script
     * @return $this
     */
    public function setScriptServer($script)
    {
        $this->scriptServer = $script;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function render() 
    {
        return sprintf($this->buffered, $this->scriptServer, $this->scriptClient);
    }

}
