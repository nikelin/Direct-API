<?php
/**
 * Base interface for a connection protocols implementation
 * 
 * @see Connection_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Connection_Protocol_Interface
{

    /**
     *  Transform request to string in format
     *  which dependent on a given protocol implementation     
     *  @return string  
     */
    public function renderRequest(Connection_Request_Interface $request);

    /**
     * Hyndrate response object from a raw data
     * which dependent on a given protocol implementation       
     * @return Connection_Response_Interface
     */
    public function hydrateResponse(Connection_Request_Interface $request, 
                                    $rawData);
}
